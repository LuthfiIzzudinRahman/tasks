# tasks
task manager adalah aplikasi untuk menampilkan/mengolah data crud dengan field: id, title, description, status, created_at, updated_at

##  dalam pembuatan aplikasi ini saya menyiapkan server dengan: 
-servername = "%"; // servernya untuk "any host"
-username = "task"
-password = "12345678"
-dbname = "task_manager"
-tableName = "tasks"
-pada server = "127.0.0.1"

## features applikasi
-create dengan id auto increment, title, deskripsi, status dengan metode drop down yang pilihan awal pending, created_at untuk tanggal pembuatan data, updated_at untuk mengubah data, kemudian klik button 
 submit untuk menyimpan
-update status dengan mengklik button update kemudian pilih field dropdown yang isinya (pending,inprogress,completed) berdasarkan id, kemudian klik button submit untuk mengubah status
-klik button delete untuk menghapus data berdasarkan id
-fitur search untuk mencari data berdasarkan title atau status dimana untuk status harus diinput secara full, contoh: pending maka untuk melihat data dengan status pending harus memasukan keywords secara 
 lengkap yaitu kata pending kemudian klik button search

 ## tech
 -aplikasi ini menggunkan XAMPP untuk menampilkan di server local
 -aplikasi ini menggunakan dbms yaitu mysql untuk menyimpan data sesuai dengan database dan isi table yang tertera di requirement
 -aplikasi ini dibangun menggunakan bahasa pemograman php
 -untuk menunjang tampilan aplikasi ini, saya juga menambahkan bootstrap untuk tampilan yang lebih baik 


