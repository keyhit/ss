
		    <a href="?edit=ShowEditForm" title="Редагувати">Ред.</a>
			</div>
			
			<div class="operationBlockForHideShow">
		    <a href="?edit=ShowEditForm" title="Приховати">Прих.</a>
			</div>

      
      <div class="operationBlockRemove">
      <a href="?remove=removePublication&id=<?php echo htmlspecialchars($media['id'], ENT_QUOTES, 'utf-8');?>&path=<?php 
	      echo htmlspecialchars($media['pathToDir'], ENT_QUOTES, 'utf-8'); 
	      echo htmlspecialchars($media['fileNaming'], ENT_QUOTES, 'utf-8');
	      ?>" title="Видалити">Вид.</a>
      </div>