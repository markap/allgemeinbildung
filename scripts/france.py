from geopy.geocoders import Nominatim
import MySQLdb

# TODO
# for whatever reason, answerid is not autoincrement
# go to phpmyadmin and set autoincrement for answer


conn = MySQLdb.connect(host= "localhost",
                       user="root",
                       passwd="",
                       db="allgemeinbildung")


cities = ['Paris', 'Marseille', 'Lyon', 'Toulouse', 'Nice',
          'Nantes', 'Strasbourg', 'Montpellier', 'Bordeaux', 'Lille',
          'Rennes', 'Reims', 'Le Havre', 'Saint-Etienne', 'Toulon']

game_list = []

for c in cities:
    geolocator = Nominatim()
    location = geolocator.geocode(c)
    x = conn.cursor()

    x.execute("""INSERT INTO answer (answer, fake1, fake2, fake3, image) VALUES ('%s#%s\n', '#map#', '#france#', ' ', 'default.jpg')""",
            (location.latitude, location.longitude))
    print(x.lastrowid)
    x.execute("""INSERT INTO question (question, answerid, image, level, creationdate, author, active, hint) VALUES (%s, %s, 'default.jpg', 1, '2010-09-27', 27, 'Y', '')""",
            (c, x.lastrowid))

    game_list.append(x.lastrowid)


print "game list is here"
print game_list
x.execute("""INSERT INTO gameList (questionids, name, qtype) VALUES (%s, 'The 15 biggest cities of France', '')""", 
         (", ".join([str(i) for i in game_list])))

print "the game id is %s" % x.lastrowid

    
conn.commit()
conn.close()



