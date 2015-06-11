import scrapy

from crawl_tucao.items import TucaobizItem

class TucaobizSpider(scrapy.Spider):
	name = "tucaobiz"
	allowed_domains = ["tucao.biz"]
	st = "http://www.tucao.biz/article-%d.html";
	start_urls = []

	f = open( "last_art")
	startnum = int( f.read()) + 1
	f.close()
	stopnum = startnum + 15
	for i in range(startnum,stopnum+1):
		url = st%i
		start_urls.append(url)

	def parse(self, response):			#main
		item = TucaobizItem()
		item['header'] = []
		item['imagesrcs'] = []
		item['url_article'] = []
		item['content'] = []
		for sel in response.xpath("//div[@class='xiaohua-data']"):
			header = sel.xpath('h1/child::text()').extract()
			content = sel.xpath('div[@class="content"]/p').extract()     #content is will be image or txt
			if(header!=[]):
				header = header[0]
				item['url_article'].append( response.url)
				item['header'].append( header)

				if content!=[] and content[0].find( "img") == -1:		#p exist .if content is not image then save content,
					item['content'].append( ''.join( content))
				else:	# this if is tepan because some content is not have p ex 17
					if content == [] and sel.xpath( 'div[@class="content"]/text()').extract() != [] and sel.xpath( 'div[@class="content"]/text()').extract()[0].find( 'img') == -1:	#content in my database is only have text,but in tucao.biz it will have images  p not exist
						item['content'].append( sel.xpath( 'div[@class="content"]/text()').extract()[0])
					else:
						item['content'].append( "")

				imageurl_download = sel.xpath(' div[@class="content"]//img/attribute::src').extract() # this find img
				if imageurl_download != []:
					imageurl_download = imageurl_download[0]
					imageurl_db = imageurl_download.split('/')[5]
					self.downImage( imageurl_download, imageurl_db)
					item[ 'imagesrcs'].append( imageurl_db)
				else:
					item[ 'imagesrcs'].append( '')
				self.itemtodatabase( item)

				#record the last article
				f = open( "last_art")
				old = int( f.read())
				f.close()
				f = open( 'last_art','w')
				Max = max( old, int( response.url.split('-')[1].split('.')[0]))
				f.write( str( Max))
				f.close()

			else:
				return
		yield item

	def itemtodatabase(self, i):
		import os
		import sys
		import time
		import MySQLdb
		reload(sys)
		sys.setdefaultencoding('utf8')

		conn=MySQLdb.connect(host='localhost',user='root',passwd='1',db='tucao',port=3306)
		conn.set_character_set('utf8')
		cur=conn.cursor()
		cur.execute('SET NAMES utf8;')
		cur.execute('SET CHARACTER SET utf8;')
		cur.execute('SET character_set_connection=utf8;')
		sql = "insert into item (item_title, item_picture,publisher,publish_time,item_detail,user_id) values('%s','%s','%s','%s','%s','%d')"

		if i['header']!=[]:
			prest = "/upload/images/"
			if i['imagesrcs'][0] == "":
				prest = ""
			i['content'][0] = i['content'][0].replace("'",'')
			sql_insert = sql%( i['header'][0], prest+i['imagesrcs'][0], 'ADMIN', time.time(),i['content'][0],1)
			flag = cur.execute(sql_insert)
			if(not flag):
				print i,"FALSE"
				return
			else:
				conn.commit()
				print "\033[44;37;5m import ",i['url_article'][0]," success! \033[0m"
		cur.close()
		conn.close()

	def downImage(self, url, name):
		import urllib2
		import os
		path = "/Users/tsunami/Sites/tucao-hot/src/upload/images/"+name
		os.system( "touch " + path)
		conn = urllib2.urlopen(url)
		f = open( path, 'wb')
		f.write(conn.read())
		f.close()
		print "\033[44;37;5m",url, "Saved! \033[0m"
