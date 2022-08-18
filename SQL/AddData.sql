USE nhathuocsuckhoeDB;

LOAD DATA INFILE 'D:/Space/NLCS/CT271_NLCS/SQL/country.csv'
INTO TABLE quocGia
FIELDS TERMINATED BY ';'
LINEs TERMINATED BY '\n'
IGNORE 1 ROWS;

LOAD DATA INFILE 'D:/Space/NLCS/CT271_NLCS/SQL/thuongHieu.csv'
INTO TABLE thuongHieu
FIELDS TERMINATED BY ';'
LINEs TERMINATED BY '\n'
IGNORE 1 ROWS
(TH_ten, QG_id, TH_logo);

LOAD DATA INFILE 'D:/Space/NLCS/CT271_NLCS/SQL/danhMucSanPham.csv'
INTO TABLE danhMucSanPham
FIELDS TERMINATED BY ';'
LINEs TERMINATED BY '\n'
IGNORE 1 ROWS
(DMSP_ten, DMSP_cap);

/*
LOAD DATA INFILE 'D:/Space/NLCS/CT271_NLCS/SQL/chuongTrinhKhuyenMai.csv'
INTO TABLE chuongTrinhKhuyenMai
FIELDS TERMINATED BY ';'
LINEs TERMINATED BY '\n'
IGNORE 1 ROWS
(CTKM_phanTram, CTKM_thoiHan);
*/

LOAD DATA INFILE 'D:/Space/NLCS/CT271_NLCS/SQL/nguoiDung.csv'
INTO TABLE nguoiDung
FIELDS TERMINATED BY ';'
LINEs TERMINATED BY '\n'
IGNORE 1 ROWS
(ND_ten, ND_sdt, ND_diaChi, ND_email, ND_matKhau, ND_quyenTruyCap);


