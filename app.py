from flask import Flask, render_template, request, redirect
import sqlite3

app = Flask(__name__)

# --- Fungsi Koneksi Database ---
def get_db_connection():
    conn = sqlite3.connect('database.db')
    conn.row_factory = sqlite3.Row
    return conn

# ---- Menampilkan Data ---
@app.route('/')
def index():
    conn = get_db_connection()
    data = conn.execute('SELECT * FROM setoran').fetchall()
    conn.close() 
    return render_template('index.html', data=data)

# --- Form Tambah Data ---
@app.route('/tambah', methods=['GET', 'POST'])
def tambah():
    if request.method == 'POST':
        nama = request.form['nama']
        jenis = request.form['jenis']
        berat = request.form['berat']
        conn = get_db_connection()
        conn.execute('INSERT INTO setoran (nama, jenis, berat) VALUES (?, ?, ?)',
                     (nama, jenis, berat))
        conn.commit()
        conn.close()
        return redirect('/')  # Redirect biar balik ke halaman utama setelah submit
    return render_template('tambah.html')

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=80, debug=True)

