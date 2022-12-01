<link rel="stylesheet" href=<?= base_url("css/priceRange.css") ?>>

<body>
    <div class="slide-container">
        <div class="min-value numberVal">
            <input type="number" min="0" max="9999" value="2500" disabled>
        </div>
        <div class="range-slider">
            <div class="progress"></div>
            <input class="range-min" type="range" min="0" max="9999" value="2500">
            <input type="range" class="range-max" min="0" max="9999" value="7500">

        </div>
        <div class="max-value numberVal">
            <input class="range-min" type="range" min="0" max="9999" value="7500" disabled>
        </div>
    </div>

    <script src=<?=base_url("js/slider.js")?>></script>
</body>