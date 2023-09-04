/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.11-MariaDB : Database - dkh_monitor_perkara
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dkh_monitor_perkara` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `dkh_monitor_perkara`;

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `menu_id` int(5) NOT NULL AUTO_INCREMENT,
  `menu_category` enum('standard-menu','mega-menu') DEFAULT 'standard-menu',
  `menu_nama` varchar(50) DEFAULT NULL,
  `menu_link` varchar(100) DEFAULT NULL,
  `menu_icon` varchar(50) DEFAULT NULL,
  `menu_parent_grid` int(1) DEFAULT 0,
  `menu_parent_id` int(5) DEFAULT NULL,
  `menu_has_arrow` int(1) DEFAULT 0,
  `menu_sort` int(5) DEFAULT 0,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `menu` */

insert  into `menu`(`menu_id`,`menu_category`,`menu_nama`,`menu_link`,`menu_icon`,`menu_parent_grid`,`menu_parent_id`,`menu_has_arrow`,`menu_sort`) values 
(1,'standard-menu','Dashboard','#','remixicon-dashboard-line',0,0,1,1),
(2,'standard-menu','Apps','#','remixicon-stack-line',0,0,0,2),
(3,'standard-menu','Layouts','#','remixicon-briefcase-5-line',0,0,0,3),
(4,'standard-menu','Components','#','remixicon-honour-line',0,0,0,4),
(5,'standard-menu','Pages','#','remixicon-file-copy-2-line',0,0,0,5),
(6,'standard-menu','Extra Pages','#','remixicon-pages-line',0,0,0,6),
(7,'standard-menu','Dashboard 1','index.html',NULL,0,1,0,1),
(8,'standard-menu','Dashboard 2','index2.html',NULL,0,1,0,2);

/*Table structure for table `perkara_perdata` */

DROP TABLE IF EXISTS `perkara_perdata`;

CREATE TABLE `perkara_perdata` (
  `perdata_id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_perkara` date NOT NULL,
  `no_perkara` varchar(30) NOT NULL,
  `agenda_perkara` text NOT NULL,
  `penanganan` text DEFAULT NULL,
  `status` enum('Upaya Hukum Banding','Upaya Hukum Kasasi','Upaya Hukum PK','Inkracht') NOT NULL,
  PRIMARY KEY (`perdata_id`,`no_perkara`),
  KEY `perdata_id` (`perdata_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `perkara_perdata` */

insert  into `perkara_perdata`(`perdata_id`,`tgl_perkara`,`no_perkara`,`agenda_perkara`,`penanganan`,`status`) values 
(1,'2020-01-01','NO PER','asdf',NULL,'Upaya Hukum Banding'),
(2,'2020-02-20','00115/PKR','Keterangan ',NULL,'Upaya Hukum Kasasi');

/*Table structure for table `perkara_perdata_pengadilan` */

DROP TABLE IF EXISTS `perkara_perdata_pengadilan`;

CREATE TABLE `perkara_perdata_pengadilan` (
  `perkara_perdata_pengadilan_id` int(11) NOT NULL AUTO_INCREMENT,
  `perdata_id` int(11) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`perkara_perdata_pengadilan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `perkara_perdata_pengadilan` */

insert  into `perkara_perdata_pengadilan`(`perkara_perdata_pengadilan_id`,`perdata_id`,`lokasi`,`tanggal`,`keterangan`) values 
(1,2,'Pengadilan Semarang','2020-02-26','menghadiri sidang');

/*Table structure for table `perkara_perdata_pengadilan_tinggi` */

DROP TABLE IF EXISTS `perkara_perdata_pengadilan_tinggi`;

CREATE TABLE `perkara_perdata_pengadilan_tinggi` (
  `perkara_perdata_pengadilan_tinggi_id` int(11) NOT NULL AUTO_INCREMENT,
  `perdata_id` int(11) NOT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`perkara_perdata_pengadilan_tinggi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `perkara_perdata_pengadilan_tinggi` */

insert  into `perkara_perdata_pengadilan_tinggi`(`perkara_perdata_pengadilan_tinggi_id`,`perdata_id`,`lokasi`,`tanggal`,`keterangan`) values 
(1,2,'Pengadilan Jawa Tengah','2020-02-26','menghadiri pengadilan jawa tengah');

/*Table structure for table `perkara_perdata_penggugat` */

DROP TABLE IF EXISTS `perkara_perdata_penggugat`;

CREATE TABLE `perkara_perdata_penggugat` (
  `perdata_penggugat_id` int(11) NOT NULL AUTO_INCREMENT,
  `perdata_id` int(11) DEFAULT NULL,
  `penggugat_tipe` enum('internal','external') DEFAULT NULL,
  `penggugat` varchar(100) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`perdata_penggugat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `perkara_perdata_penggugat` */

/*Table structure for table `perkara_perdata_tergugat` */

DROP TABLE IF EXISTS `perkara_perdata_tergugat`;

CREATE TABLE `perkara_perdata_tergugat` (
  `perdata_tergugat_id` int(11) NOT NULL AUTO_INCREMENT,
  `perdata_id` int(11) DEFAULT NULL,
  `tergugat_tipe` enum('internal','external') DEFAULT NULL,
  `tergugat` varchar(100) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`perdata_tergugat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `perkara_perdata_tergugat` */

/*Table structure for table `perkara_perdata_turut_tergugat` */

DROP TABLE IF EXISTS `perkara_perdata_turut_tergugat`;

CREATE TABLE `perkara_perdata_turut_tergugat` (
  `perdata_turut_tergugat_id` int(11) NOT NULL AUTO_INCREMENT,
  `perdata_id` int(11) DEFAULT NULL,
  `turut_tergugat_tipe` enum('internal','external') DEFAULT NULL,
  `turut_tergugat` varchar(100) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`perdata_turut_tergugat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `perkara_perdata_turut_tergugat` */

/*Table structure for table `perkara_pidana` */

DROP TABLE IF EXISTS `perkara_pidana`;

CREATE TABLE `perkara_pidana` (
  `pidana_id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_perkara` date DEFAULT NULL,
  `no_perkara` varchar(30) NOT NULL,
  `permasalahan` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tuntutan` varchar(100) DEFAULT NULL,
  `status` enum('Penyelidikan','Penyidikan','Penuntutan','Putusan') DEFAULT NULL,
  PRIMARY KEY (`pidana_id`,`no_perkara`),
  KEY `perdata_id` (`pidana_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `perkara_pidana` */

insert  into `perkara_pidana`(`pidana_id`,`tgl_perkara`,`no_perkara`,`permasalahan`,`keterangan`,`tuntutan`,`status`) values 
(1,'2020-01-16','0000011111','permasalahan','Kasus pidana','Keterangan Tuntutan','Penyelidikan');

/*Table structure for table `perkara_pidana_kejaksaan` */

DROP TABLE IF EXISTS `perkara_pidana_kejaksaan`;

CREATE TABLE `perkara_pidana_kejaksaan` (
  `perkara_pidana_kejaksaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `pidana_id` int(11) DEFAULT NULL,
  `tempat` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`perkara_pidana_kejaksaan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `perkara_pidana_kejaksaan` */

insert  into `perkara_pidana_kejaksaan`(`perkara_pidana_kejaksaan_id`,`pidana_id`,`tempat`) values 
(1,1,'Kejaksaan Semarang');

/*Table structure for table `perkara_pidana_pengadilan` */

DROP TABLE IF EXISTS `perkara_pidana_pengadilan`;

CREATE TABLE `perkara_pidana_pengadilan` (
  `perkara_pidana_pengadilan_id` int(11) NOT NULL AUTO_INCREMENT,
  `pidana_id` int(11) DEFAULT NULL,
  `tempat` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`perkara_pidana_pengadilan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `perkara_pidana_pengadilan` */

/*Table structure for table `perkara_pidana_polda` */

DROP TABLE IF EXISTS `perkara_pidana_polda`;

CREATE TABLE `perkara_pidana_polda` (
  `perkara_pidana_polda_id` int(11) NOT NULL AUTO_INCREMENT,
  `pidana_id` int(11) DEFAULT NULL,
  `tempat` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`perkara_pidana_polda_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `perkara_pidana_polda` */

/*Table structure for table `perkara_pidana_polres` */

DROP TABLE IF EXISTS `perkara_pidana_polres`;

CREATE TABLE `perkara_pidana_polres` (
  `perkara_pidana_polres_id` int(11) NOT NULL AUTO_INCREMENT,
  `pidana_id` int(11) DEFAULT NULL,
  `tempat` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`perkara_pidana_polres_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `perkara_pidana_polres` */

insert  into `perkara_pidana_polres`(`perkara_pidana_polres_id`,`pidana_id`,`tempat`) values 
(1,1,'Polres Semarang');

/*Table structure for table `unit_kerja` */

DROP TABLE IF EXISTS `unit_kerja`;

CREATE TABLE `unit_kerja` (
  `unit_kerja_id` varchar(15) NOT NULL,
  `unit_kerja_induk` varchar(15) DEFAULT NULL,
  `unit_kerja_nama` varchar(100) DEFAULT NULL,
  `unit_kerja_kota` varchar(50) DEFAULT NULL,
  `unit_kerja_jenis` varchar(50) DEFAULT NULL,
  `show` int(1) DEFAULT 1,
  PRIMARY KEY (`unit_kerja_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `unit_kerja` */

insert  into `unit_kerja`(`unit_kerja_id`,`unit_kerja_induk`,`unit_kerja_nama`,`unit_kerja_kota`,`unit_kerja_jenis`,`show`) values 
('001','001','Kantor Pusat','Semarang','Kantor Pusat',0),
('001AKA','001','Divisi Akuntansi dan Pengendalian Keuangan','Semarang','Kantor Pusat',1),
('001AMU','001','Tim AMU, Restrukturisasi dan Penyelesaian Kredit','Semarang','Kantor Pusat',1),
('001APU','001','Tim APU & PPT','Semarang','Kantor Pusat',1),
('001DAI','001','Divisi Audit Intern','Semarang','Kantor Pusat',1),
('001DBK','001','Divisi Bisnis Korporasi dan Komersial','Semarang','Kantor Pusat',1),
('001DBR','001','Divisi Bisnis Ritel dan Konsumer','Semarang','Kantor Pusat',1),
('001DEK','001','Dewan Komisaris','Semarang','Kantor Pusat',1),
('001DIR','001','Dewan Direksi','Semarang','Kantor Pusat',0),
('001DKH','001','Divisi Kepatuhan','Semarang','Kantor Pusat',1),
('001DMR','001','Divisi Manajemen Risiko','Semarang','Kantor Pusat',1),
('001DPK','001','Divisi Pemasaran dan Kebijakan Dana Korporasi','Semarang','Kantor Pusat',1),
('001DPL','001','Dana Pensiun Lembaga Keuangan','Semarang','Kantor Pusat',1),
('001DPR','001','Divisi Pemasaran dan Kebijakan Dana Ritel','Semarang','Kantor Pusat',1),
('001DPS','001','Dewan Pengawas Syariah','Semarang','Kantor Pusat',1),
('001DTI','001','Divisi Treasury dan Internasional','Semarang','Kantor Pusat',1),
('001EKS','001','Eksekutif Senior','Semarang','Kantor Pusat',1),
('001JJL','001','Divisi Jaringan dan Jasa Layanan','Semarang','Kantor Pusat',1),
('001KAU','001','Komite Audit','Semarang','Kantor Pusat',1),
('001KON','001','Konsultan Kantor Pusat','Semarang','Kantor Pusat',1),
('001KPR','001','Komite Pemantauan Risiko','Semarang','Kantor Pusat',1),
('001KRN','001','Komite Nominasi dan Renumerasi','Semarang','Kantor Pusat',1),
('001MPP','001','Masa Persiapan Pensiun','Semarang','Kantor Pusat',0),
('001PMO','001','Project Management Officer','Semarang','Kantor Pusat',1),
('001PNP','001SDM','Penampungan Outsourcing','Semarang','Kantor Pusat',0),
('001PPB','001','Divisi Perencanaan dan Pengembangan Bisnis','Semarang','Kantor Pusat',1),
('001PPE','001','Pendidikan dan Pelatihan','Semarang','Kantor Pusat',1),
('001SDM','001','Divisi Sumber Daya Manusia','Semarang','Kantor Pusat',1),
('001SKR','001','Sekretaris Perusahaan','Semarang','Kantor Pusat',1),
('001SYA','001','Divisi Syariah','Semarang','Kantor Pusat',1),
('001TKM','001','Tim Tata Kelola dan Manajemen Risiko Terintegrasi','Semarang','Kantor Pusat',1),
('001TMT','001','Tim Manajemen Transformasi','Semarang','Kantor Pusat',1),
('001TSI','001','Divisi Teknologi Sistem Informasi','Semarang','Kantor Pusat',1),
('001UMK','001','Divisi UMKM dan Konsumer','Semarang','Kantor Pusat',1),
('001UMM','001','Divisi Umum','Semarang','Kantor Pusat',1),
('002','002','Kantor Cabang Koordinator Surakarta','Surakarta','koordinator',1),
('002SYA','002SYA','Kantor Cabang Syariah Surakarta','Surakarta','cabang',1),
('003','003','Kantor Cabang Koordinator Purwokerto','Purwokerto','koordinator',1),
('003SYA','003SYA','Kantor Cabang Syariah Purwokerto','Purwokerto','cabang',1),
('004','004','Kantor Cabang Koordinator Tegal','Tegal','koordinator',1),
('005','005','Kantor Cabang Koordinator Magelang','Magelang','koordinator',1),
('006','006','Kantor Cabang Koordinator Pati','Pati','koordinator',1),
('007','004','Kantor Cabang Pekalongan','Pekalongan','cabang',1),
('007SYA','007SYA','Kantor Cabang Syariah Pekalongan','Pekalongan','cabang',1),
('008','005','Kantor Cabang Kebumen','Kebumen','cabang',1),
('009','002','Kantor Cabang Klaten','Klaten','cabang',1),
('010','002','Kantor Cabang Sragen','Sragen','cabang',1),
('011','002','Kantor Cabang Wonogiri','Wonogiri','cabang',1),
('012','003','Kantor Cabang Cilacap','Cilacap','cabang',1),
('013','003','Kantor Cabang Banjarnegara','Banjarnegara','cabang',1),
('014','005','Kantor Cabang Temanggung','Temanggung','cabang',1),
('015','006','Kantor Cabang Jepara','Jepara','cabang',1),
('016','006','Kantor Cabang Blora','Blora','cabang',1),
('017','021','Kantor Cabang Purwodadi','Purwodadi','cabang',1),
('018','021','Kantor Cabang Kendal','Kendal','cabang',1),
('019','002','Kantor Cabang Karanganyar','Karanganyar','cabang',1),
('020','005','Kantor Cabang Purworejo','Purworejo','cabang',1),
('021','021','Kantor Cabang Koordinator Semarang','Semarang','koordinator',1),
('021SYA','021SYA','Kantor Cabang Syariah Semarang','Semarang','cabang',1),
('022','021','Kantor Cabang Ungaran','Ungaran','cabang',1),
('023','005','Kantor Cabang Wonosobo','Wonosobo','cabang',1),
('024','006','Kantor Cabang Kudus','Kudus','cabang',1),
('024SYA','024SYA','Kantor Cabang Syariah Kudus','Kudus','cabang',1),
('025','004','Kantor Cabang Pemalang','Pemalang','cabang',1),
('026','002','Kantor Cabang Boyolali','Boyolali','cabang',1),
('027','003','Kantor Cabang Purbalingga','Purbalingga','cabang',1),
('028','004','Kantor Cabang Brebes','Brebes','cabang',1),
('029','006','Kantor Cabang Rembang','Rembang','cabang',1),
('030','002','Kantor Cabang Sukoharjo','Sukoharjo','cabang',1),
('031','021','Kantor Cabang Demak','Demak','cabang',1),
('032','004','Kantor Cabang Batang','Batang','cabang',1),
('033','021','Kantor Cabang Salatiga','Salatiga','cabang',1),
('034','034','Kantor Cabang Utama','Semarang','cabang',1),
('035','004','Kantor Cabang Slawi','Slawi','cabang',1),
('036','036','Kantor Cabang Jakarta','Jakarta','cabang',1),
('037','004','Kantor Cabang Kajen','Pekalongan','cabang',1),
('038','005','Kantor Cabang Yogyakarta','Yogyakarta','cabang',1),
('051','021','Cabang Pembantu UNNES Semarang','Semarang','capem',1),
('052','021','Cabang Pembantu Kaligawe Semarang','Semarang','capem',1),
('053','021','Cabang Pembantu Sampangan Semarang','Semarang','capem',1),
('054','021','Cabang Pembantu Pasar Johar Semarang','Semarang','capem',1),
('055','021','Cabang Pembantu POLINES Semarang','Semarang','capem',1),
('056','021','Cabang Pembantu IAIN Walisongo Semarang','Semarang','capem',1),
('057','034','Cabang Pembantu Setwilda Semarang','Semarang','capem',1),
('058','021','Cabang Pembantu Plasa Simpang Lima Semarang','Semarang','capem',1),
('059','002','Cabang Pembantu Manahan Surakarta','Surakarta','capem',1),
('060','024','Cabang Pembantu Plasa Kudus','Kudus','capem',1),
('062','005','Cabang Pembantu Muntilan Magelang','Magelang','capem',1),
('063','010','Cabang Pembantu Gemolong Sragen','Sragen','capem',1),
('064','011','Cabang Pembantu Baturetno Wonogiri','Wonogiri','capem',1),
('065','012','Cabang Pembantu Majenang Cilacap','Cilacap','capem',1),
('066','008','Cabang Pembantu Gombong Kebumen','Kebumen','capem',1),
('067','014','Cabang Pembantu Parakan Temanggung','Temanggung','capem',1),
('068','015','Cabang Pembantu Pecangaan Jepara','Jepara','capem',1),
('069','016','Cabang Pembantu Cepu Blora','Blora','capem',1),
('070','028','Cabang Pembantu Bumiayu Brebes','Brebes','capem',1),
('071','008','Cabang Pembantu Prembun Kebumen','Kebumen','capem',1),
('072','009','Cabang Pembantu Pedan Klaten','Klaten','capem',1),
('073','022','Cabang Pembantu Ungaran Kota','Ungaran','capem',1),
('074','009','Cabang Pembantu Plasa Klaten','Klaten','capem',1),
('075','030','Cabang Pembantu Kartasura Sukoharjo','Sukoharjo','capem',1),
('076','002','Cabang Pembantu Gading Surakarta','Surakarta','capem',1),
('077','009','Cabang Pembantu Wedi Klaten','Klaten','capem',1),
('078','009','Cabang Pembantu Jatinom Klaten','Klaten','capem',1),
('079','011','Cabang Pembantu Pracimantoro Wonogiri','Wonogiri','capem',1),
('080','011','Cabang Pembantu Jatisrono Wonogiri','Wonogiri','capem',1),
('081','026','Cabang Pembantu Sunggingan Boyolali','Boyolali','capem',1),
('082','026','Cabang Pembantu Simo Boyolali','Boyolali','capem',1),
('083','032','Cabang Pembantu Limpung Batang','Batang','capem',1),
('084','032','Cabang Pembantu Pasar Kota Batang','Batang','capem',1),
('085','017','Cabang Pembantu Wirosari Purwodadi','Purwodadi','capem',1),
('086','003','Cabang Pembantu Pasar Wage Purwokerto','Purwokerto','capem',1),
('087','037','Cabang Pembantu Wiradesa Kajen','Pekalongan','capem',1),
('088','021','Cabang Pembantu Satrio Wibowo Semarang','Semarang','capem',1),
('089','021','Cabang Pembantu Kagok Semarang','Semarang','capem',1),
('090','021','Cabang Pembantu Majapahit Semarang','Semarang','capem',1),
('091','021','Cabang Pembantu Metro Peterongan Semarang','Semarang','capem',1),
('092','006','Cabang Pembantu Juana Pati','Pati','capem',1),
('093','015','Cabang Pembantu Bangsri Jepara','Jepara','capem',1),
('094','015','Cabang Pembantu Mayong Jepara','Jepara','capem',1),
('095','016','Cabang Pembantu Kota Blora','Blora','capem',1),
('096','005','Cabang Pembantu Grabag Magelang','Magelang','capem',1),
('097','005','Cabang Pembantu Rejowinangun Magelang','Magelang','capem',1),
('098','020','Cabang Pembantu Baledono Purworejo','Purworejo','capem',1),
('099','021','Cabang Pembantu UDINUS Semarang','Semarang','capem',1),
('100','008','Cabang Pembantu Karanganyar Kebumen','Kebumen','capem',1),
('101','022','Cabang Pembantu Babadan Ungaran','Ungaran','capem',1),
('102','014','Cabang Pembantu Ngadirejo Temanggung','Temanggung','capem',1),
('103','010','Cabang Pembantu Kota Sragen','Sragen','capem',1),
('104','023','Cabang Pembantu Kertek Wonosobo','Wonosobo','capem',1),
('105','004','Cabang Pembantu Kota Tegal','Tegal','capem',1),
('106','013','Cabang Pembantu Klampok Banjarnegara','Banjarnegara','capem',1),
('107','020','Cabang Pembantu Kutoarjo Purworejo','Purworejo','capem',1),
('108','005','Cabang Pembantu Borobudur Magelang','Magelang','capem',1),
('109','007','Cabang Pembantu Kajen','Pekalongan','capem',1),
('110','002','Cabang Pembantu Nusukan Surakarta','Surakarta','capem',1),
('111','025','Cabang Pembantu Comal Pemalang','Pemalang','capem',1),
('112','011','Cabang Pembantu RSU Wonogiri','Wonogiri','capem',1),
('113','003','Cabang Pembantu Ajibarang Purwokerto','Purwokerto','capem',1),
('114','035','Cabang Pembantu Banjaran Slawi','Slawi','capem',1),
('115','008','Cabang Pembantu Kutowinangun Kebumen','Kebumen','capem',1),
('116','019','Cabang Pembantu Karangpandan Karanganyar','Karanganyar','capem',1),
('117','026','Cabang Pembantu Karanggedhe Boyolali','Boyolali','capem',1),
('118','017','Cabang Pembantu Kota Purwodadi','Purwodadi','capem',1),
('119','015','Cabang Pembantu Kota Jepara','Jepara','capem',1),
('120','003','Cabang Pembantu Sokaraja Purwokerto','Purwokerto','capem',1),
('121','012','Cabang Pembantu Kroya Cilacap','Cilacap','capem',1),
('122','027','Cabang Pembantu Bobotsari Purbalingga','Purbalingga','capem',1),
('123','019','Cabang Pembantu Palur Karanganyar','Karanganyar','capem',1),
('124','030','Cabang Pembantu Tawangsari Sukoharjo','Sukoharjo','capem',1),
('125','027','Cabang Pembantu Pasar Kota Purbalingga','Purbalingga','capem',1),
('126','028','Cabang Pembantu Ketanggungan Brebes','Brebes','capem',1),
('127','029','Cabang Pembantu Pasar Kota Rembang','Rembang','capem',1),
('128','024','Cabang Pembantu Pasar Kliwon Kudus','Kudus','capem',1),
('129','018','Cabang Pembantu Weleri Kendal','Kendal','capem',1),
('130','018','Cabang Pembantu Boja Kendal','Kendal','capem',1),
('131','030','Cabang Pembantu Nguter Sukoharjo','Sukoharjo','capem',1),
('132','012','Cabang Pembantu Cilacap Kota','Cilacap','capem',1),
('133','025','Cabang Pembantu Kota Pemalang','Pemalang','capem',1),
('134','025','Cabang Pembantu Randudongkal Pemalang','Pemalang','capem',1),
('135','005','Cabang Pembantu Bandongan Magelang','Magelang','capem',1),
('136','009','Cabang Pembantu Delanggu Klaten','Klaten','capem',1),
('137','012','Cabang Pembantu Sidareja Cilacap','Cilacap','capem',1),
('138','009','Cabang Pembantu Prambanan Klaten','Klaten','capem',1),
('139','006','Cabang Pembantu Tayu Pati','Pati','capem',1),
('140','019','Cabang Pembantu Jatipuro Karanganyar','Karanganyar','capem',1),
('142','002SYA','Cabang Pembantu Syariah UMS Surakarta','Surakarta','capem',1),
('143','013','Cabang Pembantu Karangkobar Banjarnegara','Banjarnegara','capem',1),
('144','019','Cabang Pembantu Kerjo Karanganyar','Karanganyar','capem',1),
('145','003','Cabang Pembantu Sumpiuh Purwokerto','Purwokerto','capem',1),
('146','011','Cabang Pembantu Purwantoro Wonogiri','Wonogiri','capem',1),
('147','032','Cabang Pembantu Bandar Batang','Batang','capem',1),
('148','021','Cabang Pembantu Banyumanik Semarang','Semarang','capem',1),
('149','003','Cabang Pembantu Wangon Purwokerto','Purwokerto','capem',1),
('150','037','Cabang Pembantu Kedungwuni Kajen','Pekalongan','capem',1),
('151','030','Cabang Pembantu Mojolaban Sukoharjo','Sukoharjo','capem',1),
('152','021SYA','Cabang Pembantu Syariah Semarang Barat','Semarang','capem',1),
('153','036','Cabang Pembantu Pasar Induk Kramatjati Jakarta','Jakarta','capem',1),
('154','021SYA','Cabang Pembantu Syariah Unissula Semarang','Semarang','capem',1),
('155','031','Cabang Pembantu Mranggen Demak','Demak','capem',1),
('156','002SYA','Cabang Pembantu Syariah Sragen','Sragen','capem',1),
('157','002','Cabang Pembantu UMS Surakarta','Surakarta','capem',1),
('158','023','Cabang Pembantu Kaliwiro Wonosobo','Wonosobo','capem',1),
('159','006','Cabang Pembantu Kayen Pati','Pati','capem',1),
('160','025','Cabang Pembantu Belik Pemalang','Pemalang','capem',1),
('161','002SYA','Cabang Pembantu Syariah Sukoharjo','Sukoharjo','capem',1),
('162','017','Cabang Pembantu Gubug Purwodadi','Purwodadi','capem',1),
('163','035','Cabang Pembantu Margasari Slawi','Slawi','capem',1),
('164','029','Cabang Pembantu Lasem Rembang','Rembang','capem',1),
('165','022','Cabang Pembantu Ambarawa Ungaran','Ungaran','capem',1),
('166','004','Cabang Pembantu Margadana Tegal','Tegal','capem',1),
('167','021SYA','Cabang Pembantu Syariah Magelang','Magelang','capem',1),
('168','028','Cabang Pembantu Jatibarang Brebes','Brebes','capem',1),
('169','021SYA','Cabang Pembantu Syariah Kudus','Kudus','capem',1),
('170','002SYA','Cabang Pembantu Syariah Boyolali','Boyolali','capem',1),
('171','007SYA','Cabang Pembantu Syariah Tegal','Tegal','capem',1),
('172','037','Cabang Pembantu Doro Kajen','Pekalongan','capem',1),
('173','005','Cabang Pembantu Salaman Magelang','Magelang','capem',1),
('174','020','Cabang Pembantu Purwodadi Purworejo','Purworejo','capem',1),
('175','013','Cabang Pembantu Wanadadi Banjarnegara','Banjarnegara','capem',1),
('176','005','Cabang Pembantu Salam Magelang','Magelang','capem',1),
('177','014','Cabang Pembantu Kranggan Temanggung','Temanggung','capem',1),
('178','029','Cabang Pembantu Kragan Rembang','Temanggung','capem',1),
('179','010','Cabang Pembantu Gondang Sragen','Sragen','capem',1),
('180','005','Cabang Pembantu Mertoyudan Magelang','Magelang','capem',1),
('181','016','Cabang Pembantu Ngawen Blora','Blora','capem',1),
('182','002SYA','Cabang Pembantu Syariah Klaten','Klaten','capem',1),
('183','021','Cabang Pembantu Ngaliyan Semarang','Semarang','capem',1),
('184','019','Cabang Pembantu Gondangrejo Karanganyar','Karanganyar','capem',1),
('185','023','Cabang Pembantu Selomerto Wonosobo','Wonosobo','capem',1),
('186','022','Cabang Pembantu Tengaran Ungaran','Ungaran','capem',1),
('187','030','Cabang Pembantu Solo Baru Sukoharjo','Sukoharjo','capem',1),
('188','021SYA','Cabang Pembantu Syariah Salatiga','Salatiga','capem',1),
('189','035','Cabang Pembantu Kemantran Slawi','Slawi','capem',1),
('190','003SYA','Cabang Pembantu Syariah Cilacap','Cilacap','capem',1),
('191','008','Cabang Pembantu Ayah Kebumen','Kebumen','capem',1),
('192','018','Cabang Pembantu Sukorejo Kendal','Kendal','capem',1),
('193','002SYA','Cabang Pembantu Syariah Wonogiri','Wonogiri','capem',1),
('194','003SYA','Cabang Pembantu Syariah Purbalingga','Purbalingga','capem',1),
('DIR','001','Direksi','Semarang','Kantor Pusat',0);

/*Table structure for table `user_login` */

DROP TABLE IF EXISTS `user_login`;

CREATE TABLE `user_login` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) DEFAULT NULL,
  `user_fullname` varchar(75) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_role` enum('user','admin') DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `user_login` */

insert  into `user_login`(`user_id`,`user_name`,`user_fullname`,`user_password`,`user_role`) values 
(1,'001DKH','Divisi Kepatuhan','21232f297a57a5a743894a0e4a801fc3','admin'),
(2,'001DKH','Divisi Kepatuhan','81c0f91606f1c929213da9fc313de569','user');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
