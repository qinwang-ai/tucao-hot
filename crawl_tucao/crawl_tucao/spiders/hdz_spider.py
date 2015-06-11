#coding=utf-8
import scrapy

from crawl_tucao.items import TucaobizItem

class HdzSpider(scrapy.Spider):
	name = "hdz"
	allowed_domains = ["www.haoduanzi.com"]
	st = "http://www.haoduanzi.com/view.asp?id=%d";
	start_urls = []

	f = open( "last_art_hdz")
	startnum = int( f.read()) + 1
	f.close()
	stopnum = startnum + 910
	for i in range(startnum,stopnum+1):
		url = st%i
		start_urls.append(url)

	def parse(self, response):
		item = TucaobizItem()
		item['header'] = []
		item['imagesrcs'] = []
		item['url_article'] = []
		item['content'] = []
		num = int( response.url.split('=')[1])
		for sel in response.xpath( "//div[@id='log%d']"%num):
			header = sel.xpath('h1/child::text()').extract()
			content = sel.xpath('div[@class="cont"]/*').extract()     #content is txt   并列
			content = ''.join( content)
			content_img = sel.xpath('div[@class="cont"]//img').extract()     #content_img is img  并列
			if(header!=[]):
				header = header[0]
				item['url_article'].append( response.url)  # from url
				item['header'].append( header)
				if content_img != []:
					item['content'].append( '')
					imageurl_download = sel.xpath(' div[@class="cont"]//img/attribute::src').extract() # this find img
					if imageurl_download != []:
						imageurl_download = imageurl_download[0]
						imageurl_db = imageurl_download.split('/')[5]
						self.downImage( imageurl_download, imageurl_db)
						item[ 'imagesrcs'].append( imageurl_db)
				else:
					if content!='':
						item['content'].append( content)
						item[ 'imagesrcs'].append( '')
				self.itemtodatabase( item)

				#record the last article
				f = open( "last_art_hdz")
				old = int( f.read())
				f.close()
				f = open( 'last_art_hdz','w')
				Max = max( old, int( response.url.split('=')[1]))
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
			i['content'] = i['content'][0]
			i['content'] = i['content'].replace("'",'')
			i['header'] = i['header'][0]
			i['imagesrcs'] = i['imagesrcs'][0]
			sql_insert = sql%( i['header'], prest+i['imagesrcs'], 'ADMIN', time.time(),i['content'],1)
			flag = cur.execute(sql_insert)
			if(not flag):
				print i,"FALSE"
				return
			else:
				conn.commit()
				print "\033[44;37;5m import ",i['url_article']," success! \033[0m"
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
