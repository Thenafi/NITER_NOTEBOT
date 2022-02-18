import re
import json
import time
from random import randrange
from selenium import webdriver
from airbnb import Api
from urllib.parse import urlparse
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.support.ui import WebDriverWait
from webdriver_manager.chrome import ChromeDriverManager
from selenium.common.exceptions import NoSuchElementException
from selenium.webdriver.support import expected_conditions as EC





driver = webdriver.Chrome(ChromeDriverManager().install())



driver.get("http://niter.edu.bd/index.php/academic/faculties")


urls = []
data = []

url_elements  = driver.find_elements_by_xpath('//div[@class="sprocket-grids-b-content overlay-mode overlay-mode-update"]/a[@href]')


for  i in url_elements :
    urls.append(i.get_attribute("href"))

print (len(urls))

for url in urls:
    try: 
        driver.get(url)
        driver.find_element_by_xpath('//*[@id="t3-content"]/div/article/section/table')
        try:
            driver.get(url)
            driver.find_element_by_xpath('//*[@id="t3-content"]/div/article/section/table')
        except:
            pass
    except:
        continue
    teacher = {
        "name" : driver.find_element_by_xpath('//table/tbody/tr[2]//p/span[@style]').text,
        "Number" : driver.find_element_by_xpath ('//table/tbody/tr[5]/td[2]').text

    }
    data.append(teacher)
    print (teacher)
driver.quit()

jsonString = json.dumps(data)
jsonFile = open("data.json", "w")
jsonFile.write(jsonString)
jsonFile.close()