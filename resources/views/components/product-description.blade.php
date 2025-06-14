<div class="product-description">
    <h2>Description</h2>
    <div class="small-description">
        <p>{{html_entity_decode($headline)}}
{{html_entity_decode($description)}}</p>

    </div>
    <div class="product-benefits">
        <h3>Why Choose {{html_entity_decode($name)}}?</h3>
        <ul>
            @foreach ($features as $feature)
            <li>🔹 {{html_entity_decode($feature)}}</li>
            @endforeach

        </ul>
    </div>
    <div class="product-sides">
        <h3>What's in the box:</h3>
        <ul>
            @foreach ($boxContents as $boxContent)
            <li>{{html_entity_decode($boxContent)}}</li>
            @endforeach
        </ul>
    </div>
</div>