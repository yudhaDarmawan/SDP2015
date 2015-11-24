
INSERT INTO `hrevisi_penilaian` (`id`, `kelas_id`, `catatan`, `status_revisi`, `tanggal_create`) VALUES
('NR1511001', 'K15001', 'proyek terlambat', 2, '2015-11-24 00:00:00'),
('NR1511002', 'K15001', 'proyek tidak di-burn', 2, '2015-11-24 00:00:00'),
('NR1511003', 'K15001', 'proyek ketambahan nilai sedikit', 2, '2015-11-24 00:00:00');

INSERT INTO `drevisi_penilaian` (`id`, `hrevisi_penilaian_id`, `mahasiswa_nrp`, `nilai_akhir_sebelum`, `nilai_akhir_sesudah`) VALUES
('DNR1511001', 'NR1511001', '213116176', 79, 80),
('DNR1511002', 'NR1511001', '213116178', 54, 80),
('DNR1511003', 'NR1511001', '213116181', 72, 80),
('DNR1511004', 'NR1511002', '213116270', 0, 70),
('DNR1511005', 'NR1511002', '213116256', 0, 80),
('DNR1511006', 'NR1511002', '213116261', 37, 90),
('DNR1511007', 'NR1511003', '213116176', 79, 70),
('DNR1511008', 'NR1511003', '213116181', 72, 80),
('DNR1511009', 'NR1511003', '213116200', 60, 70);

