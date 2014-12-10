<paper-tabs noink selected="0" selectedindex="0" class="tabsBar" id="studioTabs" layout center horizontal>
    <paper-tab class="tabsBarTab" layout horizontal flex inline center-center>Kurse</paper-tab>
    <paper-tab class="tabsBarTab" layout horizontal flex inline center-center>Tarife</paper-tab>
    <paper-tab class="tabsBarTab" layout horizontal flex inline center-center>Zertifikate</paper-tab>
    <paper-tab class="tabsBarTab" layout horizontal flex inline center-center>Rechnungsdaten</paper-tab>
    <paper-tab class="tabsBarTab" layout horizontal flex inline center-center>Abrechnungsdaten</paper-tab>
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