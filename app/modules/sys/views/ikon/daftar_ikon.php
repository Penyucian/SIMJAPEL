<div class="panel">
    <div class="panel-body">
        <?php
        if ($kategoriIkon) {
            foreach ($kategoriIkon as $objKategoriIkon) {
                echo "<h4 class='text-warning'>" . ucwords($objKategoriIkon['css_icon_kategori']) . "</h4>";
                echo "<div class='row'>";
                foreach ($listIkon as $objIkon) {
                    if ($objIkon['css_icon_kategori'] == $objKategoriIkon['css_icon_kategori']) {
                        echo "<div class='col-md-3 col-sm-4'><a rel='async' href='#' ajaxify='" . site_url('sys/ikon/set_ikon/' . urlencode($objIkon['css_icon_nama'])) . "'><i class='fa $objIkon[css_icon_nama]'></i>&nbsp;&nbsp;&nbsp;&nbsp;$objIkon[css_icon_nama]</a></div>";
                    }
                }
                echo "</div>";
            }
        }
        ?>
    </div>
</div>