import json
from random import randrange
from unicodedata import name
from selenium import webdriver
from urllib.parse import urlparse
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.support import expected_conditions as EC


driver = webdriver.Chrome(ChromeDriverManager().install())


driver.get("http://niter.edu.bd/index.php/academic/faculties")


urls = []
data = []


url_elements = driver.find_elements_by_xpath(
    '//div[@class="sprocket-grids-b-content overlay-mode overlay-mode-update"]/a[@href]')


for i in url_elements:
    urls.append(i.get_attribute("href"))

print(len(urls))

for url in urls:
    numberClean = []
    try:
        driver.get(url)
        driver.find_element_by_xpath(
            '//*[@id="t3-content"]/div/article/section/table')
        try:
            driver.get(url)
            driver.find_element_by_xpath(
                '//*[@id="t3-content"]/div/article/section/table')
        except:
            try:
                driver.get(url)
                driver.find_element_by_xpath(
                    '//*[@id="t3-content"]/div/article/section/table')
            except:
                pass
    except:
        continue

    # here we are searching for name
    try:
        try:
            namee = driver.find_element_by_xpath(
                '//table/tbody/tr[2]//p/span[@style="color: #000000; font-size: 18pt;"]').text
        except:
            try:
                namee = driver.find_element_by_xpath(
                    '//table/tbody/tr[2]//p/span[@style="font-size: 18pt; color: #000000;"]').text
            except:
                try:
                    namee = driver.find_element_by_xpath(
                        '//table/tbody/tr[2]//p//span[@style="font-size: 18pt;"]').text
                except:
                    namee = driver.find_element_by_xpath(
                        '//*[@id="t3-content"]/div/article/header/h1/a').text

    except:
        namee = "No Name"

    # finding number
    number = driver.find_element_by_xpath(
        '//td//*[contains(text(),"1")]/ancestor::td').text.split(", ")
    for i in number:
        x = i.replace("(", "")
        x = x.replace(" ", "")
        x = x.replace(")", "")
        x = x.replace("-", "")

        numberClean.append(x)

    # finding email
    email = driver.find_element_by_xpath(
        '//td//*[contains(text(),"@")]/ancestor::td').text.split(", ")
    if email[0].find("\n") > 1:
        email = driver.find_element_by_xpath(
            '//td//*[contains(text(),"@")]/ancestor::td').text.split("\n")

    teacher = {
        "url ": url,
        "name": namee,
        "number": numberClean,
        "email": email

    }
    data.append(teacher)
    print(teacher)
driver.quit()

jsonString = json.dumps(data)
jsonFile = open("data.json", "w")
jsonFile.write(jsonString)
jsonFile.close()
