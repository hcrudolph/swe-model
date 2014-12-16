<paper-tabs noink selected="0" selectedindex="0" class="tabsBar" id="ListsTabs" layout center horizontal>
    <paper-tab class="tabsBarTab" layout horizontal flex inline center-center>Trainer</paper-tab>
    <paper-tab class="tabsBarTab" layout horizontal flex inline center-center>Mitarbeiter</paper-tab>
    <paper-tab class="tabsBarTab" layout horizontal flex inline center-center>Mitglieder</paper-tab>
</paper-tabs>


<core-pages selected="0" selectedindex="0" notap class="tabsPages" id="ListsTabsPages">
    <div id="ListsTabsPagesTrainer"></div>
    <div id="ListsTabsPagesMitarbeiter"></div>
    <div id="ListsTabsPagesMitglieder"></div>
</core-pages>


<?php
echo $this->Html->scriptStart(array('inline' => true));
?>
$('#ListsTabsPagesTrainer').load('<?php echo $this->webroot."Lists/trainer/"?>');

var paperTabs = document.querySelector('#ListsTabs');
var corePages = document.querySelector('#ListsTabsPages');

paperTabs.addEventListener('core-select', function(e) {
      if (e.detail.isSelected) {
        switch(paperTabs.selected)
        {
            case 0: $('#ListsTabsPagesTrainer').load('<?php echo $this->webroot."Lists/trainer/"?>'); break;
            case 1: $('#ListsTabsPagesMitarbeiter').load('<?php echo $this->webroot."Lists/mitarbeiter/"?>'); break;
            case 2: $('#ListsTabsPagesMitglieder').load('<?php echo $this->webroot."Lists/mitglieder/"?>'); break;
        }
        corePages.selected = paperTabs.selected;
      }
    });


<?php
echo $this->Html->scriptEnd();
?>