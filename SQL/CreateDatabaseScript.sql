DROP DATABASE IF EXISTS nhathuocsuckhoeDB;
CREATE DATABASE nhathuocsuckhoeDB;

ALTER DATABASE nhathuocsuckhoeDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;

USE nhathuocsuckhoeDB;

CREATE TABLE quocGia (
    QG_id VARCHAR(2) NOT NULL,
    QG_ten VARCHAR(50),
    primary key (QG_id)
);

CREATE TABLE thuongHieu (
    TH_id INT NOT NULL AUTO_INCREMENT,
    TH_ten VARCHAR(50),
    QG_id VARCHAR(2) NOT NULL,
    TH_logo TEXT,
    primary key (TH_id)
);

CREATE TABLE danhMucSanPham (
    DMSP_id INT NOT NULL AUTO_INCREMENT,
    DMSP_ten VARCHAR(50),
    DMSP_cap INT NOT NULL,
    primary key (DMSP_id)
);

CREATE TABLE chuongTrinhKhuyenMai (
    CTKM_id INT NOT NULL AUTO_INCREMENT,
    CTKM_phanTram INT NOT NULL,
    CTKM_thoiHan TIMESTAMP,
    primary key (CTKM_id)
);

CREATE TABLE nguoiDung (
    ND_id INT NOT NULL AUTO_INCREMENT,
    ND_ten TEXT NOT NULL,
    ND_sdt INT NOT NULL,
    ND_diaChi TEXT,
    ND_email TEXT,
    ND_matKhau TEXT NOT NULL,
    ND_quyenTruyCap INT NOT NULL,
    diemTichLuy INT, /*Danh cho Khach Hang*/
    primary key (ND_id)
);

CREATE TABLE donHang (
    DH_id INT NOT NULL AUTO_INCREMENT,
    ND_id_KH INT NOT NULL,
    ND_id_QLBH INT NOT NULL DEFAULT -1,
    DH_ngayLap TIMESTAMP,
    DH_diaChiGiaoHang TEXT,
    DH_trangThai TEXT,
    primary key (DH_id)
);

CREATE TABLE sanPham (
    SP_id INT NOT NULL AUTO_INCREMENT,
    SP_ten TEXT,
    SP_hinhAnh TEXT,
    MTSP_id INT NOT NULL,
    SP_giaNiemYet INT NOT NULL DEFAULT 0,
    CTKM_id INT NOT NULL DEFAULT -1,
    primary key (SP_id)
);

CREATE TABLE moTaSanPham (
    MTSP_id INT NOT NULL AUTO_INCREMENT,
    MTSP_congDung TEXT,
    MTSP_huongDanSuDung TEXT,
    MTSP_quiCach VARCHAR(20),
    QG_id VARCHAR(2) NOT NULL,
    TH_id INT NOT NULL DEFAULT -1,
    DMSP_id INT NOT NULL,
    SP_id INT NOT NULL,
    primary key (MTSP_id)
);

CREATE TABLE chiTietDonHang (
    CTDH_id INT NOT NULL AUTO_INCREMENT,
    DH_id INT NOT NULL,
    SP_id INT NOT NULL,
    CTDH_soLuong INT NOT NULL DEFAULT 1,
    primary key (CTDH_id)
);

ALTER TABLE thuongHieu
ADD CONSTRAINT QG_id_in_quocGia_thuongHieu
FOREIGN KEY (QG_id) REFERENCES quocGia(QG_id);

ALTER TABLE moTaSanPham
ADD CONSTRAINT TH_id_in_thuongHieu_moTaSanPham
FOREIGN KEY (TH_id) REFERENCES thuongHieu(TH_id);

ALTER TABLE moTaSanPham
ADD CONSTRAINT QG_id_in_quocGia_moTaSanPham
FOREIGN KEY (QG_id) REFERENCES quocGia(QG_id);

ALTER TABLE moTaSanPham
ADD CONSTRAINT DMSP_id_in_danhMucSanPham_moTaSanPham
FOREIGN KEY (DMSP_id) REFERENCES danhMucSanPham(DMSP_id);

ALTER TABLE sanPham
ADD CONSTRAINT MTSP_id_in_moTaSanPham_sanPham
FOREIGN KEY (MTSP_id) REFERENCES moTaSanPham(MTSP_id);

ALTER TABLE sanPham
ADD CONSTRAINT CTKM_id_in_chuongTrinhKhuyenMai_sanPham
FOREIGN KEY (CTKM_id) REFERENCES chuongTrinhKhuyenMai(CTKM_id);

###

ALTER TABLE donHang
ADD CONSTRAINT ND_id_KH_in_nguoiDung_donHang
FOREIGN KEY (ND_id_KH) REFERENCES nguoiDung(ND_id);

ALTER TABLE donHang
ADD CONSTRAINT ND_id_QLBH_in_nguoiDung_donHang
FOREIGN KEY (ND_id_QLBH) REFERENCES nguoiDung(ND_id);

ALTER TABLE chiTietDonHang
ADD CONSTRAINT DH_id_in_donHang_chiTietDonHang
FOREIGN KEY (DH_id) REFERENCES donHang(DH_id);

ALTER TABLE chiTietDonHang
ADD CONSTRAINT SP_id_in_sanPham_chiTietDonHang
FOREIGN KEY (SP_id) REFERENCES sanPham(SP_id);
