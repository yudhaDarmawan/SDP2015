<htmlpageheader name="MyHeader1">
    <div style="text-align: right; border-bottom: 1px solid #000000; font-weight: bold; font-size: 10pt;"><?php echo $title;?></div>
    <img src="<?php echo base_url('assets/images/headerLaporan.jpg');?>" >
</htmlpageheader>

<htmlpagefooter name="MyFooter1">
    <table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt;
    color: #000000; font-weight: bold; font-style: italic;"><tr>
            <td width="33%"><span style="font-weight: bold; font-style: italic;">{DATE j-m-Y}</span></td>
            <td width="33%" style="text-align: right;font-style: italic; ">{PAGENO}/{nbpg}</td>
        </tr></table>
</htmlpagefooter>

<sethtmlpageheader name="MyHeader1" value="on" />
<sethtmlpagefooter name="MyFooter1" value="on" />

<img src="<?php echo base_url('assets/images/headerLaporan.jpg');?>" >

