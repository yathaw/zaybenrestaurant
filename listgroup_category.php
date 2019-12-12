<div class="list-group">
          
  <?php 
    $sql="SELECT categories.*, count(items.category_id) as total_category        
      from categories
      left join items
      on (items.category_id = categories.id)
      group by
          items.category_id
          ORDER BY categories.name ASC";
    
    $stmt=$pdo->prepare($sql);
    $stmt->execute();
    $rows= $stmt->fetchAll();

    foreach ($rows as $category):
  ?>
  <a href="special?id=<?= $category['id'] ?>" class="list-group-item"> 
    <?= $category['name'] ?> 
    ( <?= $category['total_category'] ?> ) 
  </a>

  <?php 
    endforeach;
  ?>

</div>