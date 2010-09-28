<?php decorate_with($page['layoutName']); ?>
<h1><?php echo $page['title']; ?></h1>
<?php foreach($page['DesignElements'] as $element): ?>
<?php   if(is_string($partials[$element['name']])): ?>
<?php     include_partial((string)$partials[$element['name']], array('contents' => $element['Contents'])); ?>
<?php   else: ?>
<?php     include_component($partials[$element['name']][0], $partials[$element['name']][1], array('contents' => $element['Contents'])); ?>
<?php   endif; ?>
<?php endforeach; ?>
