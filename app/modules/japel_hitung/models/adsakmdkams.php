select kdj.doctor_id,
SUM(((kdj.harga_jasa / k.penyebut_profesi) * k.alokasi_profesi)) AS final
        from kwitansi k
        join kwitansi_detail kd on k.id = kd.kwitansi_id
        join kwitansi_detail_jasa kdj on kd.id = kdj.kwitansi_detail_id AND kdj.doctor_id IS NOT NULL
        where kdj.komponen_biaya_subject_id not in (14, 54)
        and k.status = 'LUNAS'
        and MONTH(k.bayar_tgl)= 04 AND YEAR(k.bayar_tgl)=
        and k.payment_type_id = 64
        group by kdj.doctor_id



        select k.id,
            k.plafon,
            kd.komponen_biaya_group_id,
            (SELECT CASE WHEN kd1.komponen_biaya_group_id = 270 THEN 1 ELSE 0 END FROM kwitansi_detail kd1 WHERE kd1.kwitansi_id = k.id AND kd1.komponen_biaya_group_id = 270) AS is_operasi,
            SUM(kdj.harga_jasa) AS penyebut_profesi')
        from kwitansi k 
        join kwitansi_detail kd on k.id = kd.kwitansi_id
        join kwitansi_detail_jasa kdj on kd.id = kdj.kwitansi_detail_id
        where kdj.komponen_biaya_subject_id =(14, 54)
        and k.status = 'LUNAS'
        and k.payment_type_id = 64
        and MONTH(k.bayar_tgl)=04 AND YEAR(k.bayar_tgl)= 2022
        group by k.id


        select k.payment_type_id, (CASE WHEN k.payment_type_id = 64 THEN ((kdj.harga_jasa / k.penyebut_profesi) * k.alokasi_profesi) else kdj.harga_jasa END)
        from kwitansi k
        join kwitansi_detail kd on k.id = kd.kwitansi_id
        join kwitansi_detail_jasa on kdj kd.id = kdj.kwitansi_detail_id AND kdj.doctor_id IS NOT NULL
        where k.status = 'LUNAS'
        and kdj.komponen_biaya_subject_id = 3
        and MONTH(k.bayar_tgl)=04 AND YEAR(k.bayar_tgl)=2022
        and k.payment_type_id = 64