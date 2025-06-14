    <div class="product-card"
     data-name="{{$name}}"
     data-category={{$category}}
     data-subcategory="{{$subCategory}}"
     data-gametype={{$gameType}}>
  <h3>{{html_entity_decode($name)}}</h3>
  <p><strong>Price:</strong> ${{$price}}</p>
  <p><strong>Category:</strong> {{html_entity_decode($category)}}</p>
  <p><strong>Subcategory:</strong> {{html_entity_decode($subCategory)}}</p>
  <div class="btn-group">
    <button class="btn-edit" onclick="window.location.href='/admin/editProduct/{{$id}}'">Edit</button>
    <button class="btn-delete" onclick="deleteProduct({{$id}}, this,'{{$name}}')">Delete</button>
  </div>
</div>