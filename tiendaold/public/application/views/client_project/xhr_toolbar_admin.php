<div class="toolbox divider">
<?php if ($permissions->project->create) { ?><span class="iconWrapper"><a onclick ="nw('mainPanel', 'project/add', 'Add New Project');" title="Add New Project"><img src="images/icons/project_add.png" width="16" height="16" alt="Add New Project" /></a></span><?php } ?><?php if ($permissions->client->create) { ?><span class="iconWrapper"><a onclick ="nw('mainPanel', 'client/add', 'Add New Client');" title="Add New Client"><img src="images/icons/client_add.png" width="16" height="16" alt="Add New Client" /></a></span><?php } ?>
</div>