<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $nextBoard->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $nextBoard->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Next Boards'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Parent Next Boards'), ['controller' => 'NextBoards', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parent Next Board'), ['controller' => 'NextBoards', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="nextBoards form large-9 medium-8 columns content">
    <?= $this->Form->create($nextBoard) ?>
    <fieldset>
        <legend><?= __('Edit Next Board') ?></legend>
        <?php
            echo $this->Form->input('parent_id', ['options' => $parentNextBoards]);
            echo $this->Form->input('person_id', ['options' => $people]);
            echo $this->Form->input('title');
            echo $this->Form->input('content');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
