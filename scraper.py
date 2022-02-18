import re
import json
import time
from random import randrange
from unicodedata import name
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
            try:
                driver.get(url)
                driver.find_element_by_xpath('//*[@id="t3-content"]/div/article/section/table')
            except:
                pass
    except:
        continue

    # here we are searching for name 
    try:
        try:
            namee = driver.find_element_by_xpath('//table/tbody/tr[2]//p/span[@style="color: #000000; font-size: 18pt;"]').text
        except:
            try:
                namee = driver.find_element_by_xpath('//table/tbody/tr[2]//p/span[@style="font-size: 18pt; color: #000000;"]').text
            except:
                try: 
                    namee = driver.find_element_by_xpath('//table/tbody/tr[2]//p//span[@style="font-size: 18pt;"]').text
                except:
                    namee = driver.find_element_by_xpath('//*[@id="t3-content"]/div/article/header/h1/a').text

    except:     
        namee  = "No Name"

    # finding number
    number = driver.find_element_by_xpath ('//td//*[contains(text(),"1")]/ancestor::td').text.split(", ")
    
    

    #finding email
    email = driver.find_element_by_xpath ('//td//*[contains(text(),"@")]/ancestor::td').text.split(", ")
    if email[0].find("\n"):
        email = driver.find_element_by_xpath ('//td//*[contains(text(),"@")]/ancestor::td').text.split("\n")
        

    teacher = {
        "url ": url,
        "name" : namee,
        "number" : number,
        "email" : email

    }
    data.append(teacher)
    print (teacher)
driver.quit()

jsonString = json.dumps(data)
jsonFile = open("data.json", "w")
jsonFile.write(jsonString)
jsonFile.close()