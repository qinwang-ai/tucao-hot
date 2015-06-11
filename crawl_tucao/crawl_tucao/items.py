# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/en/latest/topics/items.html

import scrapy

class TucaobizItem(scrapy.Item):
	url_article = scrapy.Field()
	header = scrapy.Field()
	imagesrcs = scrapy.Field()
	content = scrapy.Field()
