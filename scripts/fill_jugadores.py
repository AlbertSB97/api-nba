from connector import connect_db, close_db
import csv

cnx = connect_db()

with open('files/jugadores.csv') as csv_file:
    reader = csv.reader(csv_file, delimiter=";", lineterminator='\n')
    next(reader)

    cursor = cnx.cursor()

    for row in reader:
        data_jugador = (row[0], row[1], row[2], row[3], row[4], row[5], row[6])
        add_jugador = """INSERT INTO 
            jugadores (
                codigo,
                nombre,
                procedencia,
                altura,
                peso,
                posicion,
                nombre_equipo) VALUES (%s,%s,%s,%s,%s,%s,%s)"""

        try:
            cursor.execute(add_jugador, data_jugador)
        except mysql.connector.Error as err:
            if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
                print("Something is wrong with your user name or password")
            elif err.errno == errorcode.ER_BAD_DB_ERROR:
                print("Database does not exist")
            else:
                print(err)

cursor.close()
cnx.commit()
cnx.rollback()
close_db(cnx)
