#coding = utf-8
import os
import sys
import json
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
f = file('items.json')
s = json.load(f)
for i in s:
	if i['header']!=[]:
		if i['imagesrcs'][0] == "":
			prest = ""
		else:
			prest = "/upload/images/"
		i['content'][0] = i['content'][0].replace("'",'')
		sql_insert = sql%( i['header'][0], prest+i['imagesrcs'][0], 'ADMIN', time.time(),i['content'][0],1)
		flag = cur.execute(sql_insert)
		if(not flag):
			print i,"FALSE"
			exit()
		else:
			conn.commit();

print "\033[44;37;5m import items_data success! \033[0m"
cur.close()
conn.close()
