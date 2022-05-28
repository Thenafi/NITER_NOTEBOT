import json
# keep table builder separate from scraper because its easier to modifie the data.json

with open("data.json") as data_file:
    data = json.load(data_file)


main_build = """   <table id="myTable" class="table">
      <tr class="header">
        <th style="width: 60%">Teacher's Name</th>
        <th style="width: 40%">Number</th>
      </tr>
 """

for profile in data:
    main_build += f"""<tr><td>{profile['name']}</td><td>"""

    for i in profile["number"]:
        main_build += f"""<a href="tel:{i}">{i}</a><br />"""
    main_build += f"""<p class="example">"""
    for i in profile["email"]:
        main_build += f"""{i}<br/>"""
    main_build += "</p></td></tr>"

main_build += "</table>"


with open("table.html", "w") as f:
    f.write(main_build)
