import sqlite3

conn = sqlite3.connect('database.db')
conn.execute('''
    CREATE TABLE IF NOT EXISTS setoran(
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nama TEXT NOT NULL,
        jenis TEXT NOT NULL,
        berat REAL NOT NULL)
''')

conn.close()
