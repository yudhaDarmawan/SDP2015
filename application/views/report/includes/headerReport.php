<htmlpageheader name="Header">
    <table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt;
    color: #000000; font-weight: bold; font-style: italic;border-bottom: 2px solid #000"><tr>
            <td width="50%"><span style="font-weight: bold; font-style: italic;">Sekolah Tinggi Teknik Surabaya</span></td>
            <td width="50%" style="text-align: right;font-style: italic; "><?php echo $title;?></td>
        </tr></table>
</htmlpageheader>

<htmlpagefooter name="MyFooter1">
    <table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt;
    color: #000000; font-weight: bold; font-style: italic;border-top: 1px solid #000"><tr>
            <td width="33%"><span style="font-weight: bold; font-style: italic;">Tanggal Cetak : {DATE j-m-Y}</span></td>
            <td width="33%" style="text-align: right;font-style: italic; ">Halaman {PAGENO} dari {nbpg}</td>
        </tr></table>
</htmlpagefooter>

<sethtmlpageheader name="Header" value="on" />
<sethtmlpagefooter name="MyFooter1" value="on" />

<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt;
    color: #000000; font-weight: bold; font-style: italic;border-bottom: 2px solid #000"><tr>
        <td width="50%"><span style="font-weight: bold; font-style: italic;">Sekolah Tinggi Teknik Surabaya</span></td>
        <td width="50%" style="text-align: right;font-style: italic; "><?php echo $title;?></td>
    </tr></table>
<br/>
<h3 style="text-align: center;text-transform:uppercase"><?php echo $title;?></h3>