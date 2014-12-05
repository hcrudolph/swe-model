<paper-tabs noink selected="0" selectedindex="0" class="tabsBar" id="studioTabs" layout center horizontal>
<?php
    echo $this->element('tabs/user');
    echo $this->element('tabs/kurs');
    echo $this->element('tabs/tarif');
    echo $this->element('tabs/zertifikat');
    echo $this->element('tabs/rechnung');
    echo $this->element('tabs/abrechnung');
?>
</paper-tabs>
