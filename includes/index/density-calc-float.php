<br><br><br><br>
<!-- Tab links -->
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">Density</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')">Mass</button>
  <button class="tablinks" onclick="openCity(event, 'Tokyo')">Volume</button>
</div>

<!-- Tab content -->
<div id="London" class="tabcontent">
    <br>
  <h5>Calculate: Density</h5>
    <?php include 'density.php'; ?>
</div>

<div id="Paris" class="tabcontent">
    <br>
  <h5>Calculate: Mass</h5>
  <?php include 'mass.php'; ?>
</div>

<div id="Tokyo" class="tabcontent">
    <br>
  <h5>Calculate: Volume</h5>
  <?php include 'volume.php'; ?>
</div>