import os
import json
import time

from selenium import webdriver

def fullpage_screenshot(url, filename):
	global driver

	# Get the size of the page using webdriver
	driver.get(url)
	print("Caling webdriver chrome to find size of browser ...")
	total_width = driver.execute_script("return document.body.offsetWidth")
	total_height = driver.execute_script("return document.body.parentNode.scrollHeight")

	# Call the cefpython script to do the actual work
	print("Caling cefpython script to take image screenshot...")
	os.system('C:/Users/kimchips/Anaconda3/envs/Rulr-2.0/python.exe apps/include/screenshot.py {0} {1} {2}'.format(url, total_width, total_height))

	# Move the file into the right location
	os.rename("apps/include/screenshot.png", filename)


driver = webdriver.Chrome('apps/chromedriver.exe')

years = os.listdir('archive')

for year in years:
	if year[0] != '2':
		continue
	print(year)

	year_path = 'archive/{0}'.format(year)
	archive_entry_paths = os.listdir(year_path)
	for archive_entry_path in archive_entry_paths:
		archive_entry_json_filename = '{0}/{1}/main.json'.format(year_path, archive_entry_path)

		try:
			if not os.path.isfile(archive_entry_json_filename):
				raise Exception("{0} does not exist".format(archive_entry_json_filename))
			description = None
			description_changed = False
			try:
				with open(archive_entry_json_filename, 'r') as file:
					description = json.load(file)
					if 'records' in description:
						records_length = len(description['records'])
						for record_index in range(records_length):
							record = description['records'][record_index]
							if 'url' in record and not 'screenshot' in record:
								url = record['url']
								filename = '{0} - Screenshot.png'.format(record['name'])
								file_path = '{0}/{1}/{2}'.format(year_path, archive_entry_path, filename)

								#delete any existing file
								if os.path.isfile(file_path):
									os.remove(file_path)

								fullpage_screenshot(url, file_path)
								description['records'][record_index]['screenshot'] = filename
								description_changed = True
				if description_changed:
					with open(archive_entry_json_filename, 'w') as file:
						json.dump(description, file)
					
			except Exception as e:
				print(archive_entry_path)
				print(e)
				pass
		except Exception as e:
			print(e)


driver.quit()