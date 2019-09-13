create database sample;

use sample;

create table musteriler(
  musteri_id int unsigned not null auto_increment primary key,
  email char(30) not null,
  sifre char(40) not null,
  telefon char(20),
  isim char(40) not null,
  adres char(80) not null,
  sehir char(20) not null,
  posta_kodu char(10),
  ulke char(20) not null
);

create table siparisler(
  siparis_id int unsigned not null auto_increment primary key,
  muster_id int unsigned not null references musteriler(musteri_id),
  toplam_fiyat float(6,2),
  tarih date not null,
  siparis_durumu char(10),
  teslimat_yontemi char(60) not null,
  teslimat_adresi char(80) not null,
  teslimat_sehir char(30) not null,
  teslimat_pk char(10),
  teslimat_ulkesi char(20) not null
);


create table kategoriler(
  kategori_id int unsigned not null auto_increment primary key,
  kategori_adi char(60) not null
);

create table kitaplar(
  isbn char(13) not null primary key,
  yazar char(100),
  baslik char(100),
  kategori_id int unsigned references kategoriler(kategori_id),
  fiyat float(4,2) not null,
  aciklama varchar(255)
);

create table siparis(
  siparis_id int unsigned not null references siparisler(siparis_id),
  isbn char(13) not null references kitaplar(isbn),
  siparis_tutari float(5,2) not null,
  siparis_adedi tinyint unsigned not null,
  primary key (siparis_id, isbn)
);

create table admin(
  kullanici_adi char(16) not null primary key,
  sifre char(40) not null references musteriler(sifre),
  kullanici_id int unsigned not null references musteriler(musteri_id)
);

create table yorumlar(
  yorum_id int unsigned not null primary key auto_increment,
  isbn char(13) not null references kitaplar(isbn),
  muster_id int unsigned not null references musteriler(musteri_id),
  tarih date not null,
  yorum varchar(255)
);

create table mesajlar(
  msg_id int unsigned not null primary key auto_increment,
  alici_id int unsigned not null references musteriler(musteri_id),
  gonderici_id int unsigned not null references musteriler(musteri_id),
  tarih date not null,
  mesaj varchar(255)
);
