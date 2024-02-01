#!/usr/bin/env python3
import urllib.request, json, os
from multiprocessing.pool import ThreadPool
from glob import glob
import sys
from  urllib.request import urlretrieve

savepath = "/usr/html/Resources/OffTrainer/"
#savepath = "/var/www/html/Resources/OffTrainer/"
ignoreItms=['LICENSE','trainer.cache','README.md','MakeCache.bat']
#function to create cache manifest file
def createManiFest():
	ManifestTxt="CACHE MANIFEST\n"
	ManifestTxt+='# random: '+os.urandom(16).hex()+'\n' # tell the browser to refresh
	ManifestTxt+="\n"+"CACHE:"
	cacheArray=[]
	#iterating thorugh base folder to list out all the files
	for itm in glob("{}*".format(savepath)):
		if os.path.basename(itm) in ignoreItms:
			#if the item is present in ignore list it will continue without adding
			continue
		if os.path.isfile(itm):
			#if file add it to cache array
			cacheArray.append(os.path.basename(itm))
	# sort the array to make the file look nice
	cacheArray.sort()
	ManifestTxt+="\n"+"\n".join(cacheArray)
	ManifestTxt+="\n\n"+"NETWORK:"
	ManifestTxt+="\n"+"*"
	ManifestTxt+="\n\n"+"SETTINGS:"
	ManifestTxt+="\n"+"prefer-online:"
	open('{}trainer.cache'.format(savepath),'w').write(ManifestTxt)

def download(url):
	file_name_start_pos = url.rfind("/") + 1
	file_name = url[file_name_start_pos:]
	try:
		if file_name.split('.')[-1] != 'jpg' or not os.path.isfile(savepath + file_name):
			urllib.request.urlretrieve(url, savepath + file_name)
	except:
		pass
        
try:
	with urllib.request.urlopen("http://ps4trainer.com/Trainer/list.json") as url:
		data_json = url.read().decode('utf-8-sig')
		data = json.loads(data_json)
		f = open(savepath + "list.json", "w")
		f.write(data_json.replace("/games", ""))
		f.close()
	gameurl=[]	
	for game in data['games']:
		gameurl.append(game['url'].replace(".", "http://ps4trainer.com/Trainer", 1))
		gameurl.append("http://ps4trainer.com/Trainer/img/" + game['title'] + ".jpg")
	#gameurl=[]
	results = ThreadPool(8).imap_unordered(download, gameurl)
	for r in results:
		pass

	createManiFest()
	os.system("sudo chmod -R ugo+rwx {}*".format(savepath))
	print('Files updated :)')
except Exception as e:
	print('Update Failed, Check for internet !!!{}'.format(str(e)))
