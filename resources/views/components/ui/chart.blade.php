@props(['options' => '{}', 'height' => '300', 'type' => 'area'])

<div x-data="{
        chart: null,
        init() {
            let passedOptions = {{ $options }};
            // Ensure basic properties are set if not provided
            let finalOptions = Object.assign({
                chart: { type: '{{ $type }}', height: {{ $height }} },
            }, passedOptions);
            
            this.chart = new window.ApexCharts(this.$refs.chartContainer, finalOptions);
            this.chart.render();
        }
    }" 
    class="w-full">
    <div x-ref="chartContainer" class="w-full" style="min-height: {{ $height }}px"></div>
</div>
