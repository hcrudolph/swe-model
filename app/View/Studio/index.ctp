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


<core-pages selected="0" selectedindex="0" notap id="studioTabsPages">
    <section>Page User</section>
    <section>Page Kurs</section>
    <section>Page Tarif</section>
    <section>Page Zertifikate</section>
    <section>Page Rechnung</section>
    <section>Page Abrechnung</section>
</core-pages>


<?php
echo $this->Html->scriptStart(array('inline' => true));
?>

var paperTabs = document.querySelector('#studioTabs');
var corePages = document.querySelector('#studioTabsPages');

paperTabs.addEventListener('core-select', function(e) {
      if (e.detail.isSelected) {
        corePages.selected = paperTabs.selected;
      }
    });


<?php
echo $this->Html->scriptEnd();
?>