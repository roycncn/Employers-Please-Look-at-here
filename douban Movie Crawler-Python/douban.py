# -*- coding: UTF-8 -*-

import sys,urllib2,urllib,csv,string,socket
import cookielib
import random
import threading, Queue, time
import lxml.html.soupparser as soupparser
from lxml.etree import tostring
import sys

FILM = list()
FILE_LOCK = threading.Lock()
SHARE_Q = Queue.Queue()  #构造一个不限制大小的的队列
_WORKER_THREAD_NUM = 1  #设置线程的个数
reload(sys)
sys.setdefaultencoding('UTF-8')

class BrowserBase(object): 

    def __init__(self):
        socket.setdefaulttimeout(20)

    def speak(self,content):
        print 'Error: %s' %(content)

    def openurl(self,url):

        cookie_support= urllib2.HTTPCookieProcessor(cookielib.CookieJar())
        self.opener = urllib2.build_opener(cookie_support,urllib2.HTTPHandler)
        urllib2.install_opener(self.opener)
        user_agents = [
                    'Mozilla/5.0 (Windows; U; Windows NT 5.1; it; rv:1.8.1.11) Gecko/20071127 Firefox/2.0.0.11',
                    'Opera/9.25 (Windows NT 5.1; U; en)',
                    'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)',
                    'Mozilla/5.0 (compatible; Konqueror/3.5; Linux) KHTML/3.5.5 (like Gecko) (Kubuntu)',
                    'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.8.0.12) Gecko/20070731 Ubuntu/dapper-security Firefox/1.5.0.12',
                    'Lynx/2.8.5rel.1 libwww-FM/2.14 SSL-MM/1.4.1 GNUTLS/1.2.9',
                    "Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Ubuntu/11.04 Chromium/16.0.912.77 Chrome/16.0.912.77 Safari/535.7",
                    "Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:10.0) Gecko/20100101 Firefox/10.0 ",

                    ] 
       
        agent = random.choice(user_agents)
        self.opener.addheaders = [("User-agent",agent),("Accept","*/*"),('Referer','http://www.google.com')]
        try:
            res = self.opener.open(url)
            print res.read()
        except Exception,e:
            self.speak(str(e)+url)
            raise Exception
        else:
            return res


class MyThread(threading.Thread) :

    def __init__(self, func) :
        super(MyThread, self).__init__()  #调用父类的构造函数
        self.func = func  #传入线程函数逻辑

    def run(self) :
        self.func()

def worker() :
    global SHARE_Q
    while not SHARE_Q.empty():
        taskUrl = SHARE_Q.get() #获得任务
        douban_craw(taskUrl)
        time.sleep(1)
        SHARE_Q.task_done()


def douban_craw(url):
	WebReader = BrowserBase()
	content = WebReader.openurl(url)
	content = content.decode("UTF-8").encode("UTF-8")
	dom = soupparser.fromstring(content)
	name = dom.xpath(".//*[@class='nbg']/@title")
	info = dom.xpath(".//*[@class='nbg']/@href")
	for i in range(0,len(name)):
		FILM.append([name[i],info[i]])



def main():
	global SHARE_Q
	thread_group = []
	userPage = "http://movie.douban.com/people/Vimo.H/wish?start={page}"
	PageNum = 340
	for index in xrange(PageNum/15):
		SHARE_Q.put(userPage.format(page = index * 15))
	for thread in xrange(_WORKER_THREAD_NUM) :
		thread = MyThread(worker)
		thread.start()
		thread_group.append(thread)
	for thread in thread_group :
		thread.join()
	SHARE_Q.join()



	csvfile=file('mt.csv','wb')
	write=csv.writer(csvfile)
	for row in FILM:
		write.writerow(row)

	print "Spider Successful!!!"


if __name__ == '__main__':
	main()