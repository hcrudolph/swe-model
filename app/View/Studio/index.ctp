<paper-tabs noink selected="0" selectedindex="0" class="tabsBar" id="studioTabs" layout center horizontal>
    <paper-tab class="tabsBarTab" layout horizontal flex inline center-center>Accounts</paper-tab>
    <paper-tab class="tabsBarTab" layout horizontal flex inline center-center>Kurse</paper-tab>
    <paper-tab class="tabsBarTab" layout horizontal flex inline center-center>Tarife</paper-tab>
    <paper-tab class="tabsBarTab" layout horizontal flex inline center-center>Zertifikate</paper-tab>
    <paper-tab class="tabsBarTab" layout horizontal flex inline center-center>Rechnungsdaten</paper-tab>
    <paper-tab class="tabsBarTab" layout horizontal flex inline center-center>Abrechnungsdaten</paper-tab>
</paper-tabs>


<core-pages selected="0" selectedindex="0" notap class="tabsPages" id="studioTabsPages">
    <div id="studioTabPageAccount"></div>
    <div id="studioTabPageKurse"></div>
    <div id="studioTabPageTarife"></div>
    <div id="studioTabPageZertifikate"></div>
    <div id="studioTabPageRechnung"></div>
    <div id="studioTabPageAbrechnung"></div>
</core-pages>


<?php
echo $this->Html->scriptStart(array('inline' => true));
?>
$('#studioTabPageAccount').load('<?php echo $this->webroot."Accounts/index/"?>');

var paperTabs = document.querySelector('#studioTabs');
var corePages = document.querySelector('#studioTabsPages');

paperTabs.addEventListener('core-select', function(e) {
      if (e.detail.isSelected) {
        switch(paperTabs.selected)
        {
            case 0: $('#studioTabPageAccount').load('<?php echo $this->webroot."Accounts/index/"?>'); break;
            case 1: $('#studioTabPageKurse').load('<?php echo $this->webroot."Courses/index/"?>'); break;
            case 2: $('#studioTabPageTarife').load('<?php echo $this->webroot."Tariffs/index/"?>'); break;
            case 3: $('#studioTabPageZertifikate').load('<?php echo $this->webroot."Certificates/index/"?>'); break;
            case 4: $('#studioTabPageRechnung').load('<?php echo $this->webroot."bills/index/"?>'); break;
            case 5: $('#studioTabPageAbrechnung').load('<?php echo $this->webroot."bills/index/"?>'); break;
        }
        corePages.selected = paperTabs.selected;
      }
    });


<?php
echo $this->Html->scriptEnd();
?>