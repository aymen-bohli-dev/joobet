<?php use_stylesheet('jobs.css') ?>
<?php slot('title', sprintf('Jobs in the %s category', $category->getName())) ?>

<div class="category">
    <div class="feed">
        <a href="">Feed</a>
    </div>
    <h1><?php echo $category ?></h1>
</div>

<table class="jobs">
    <?php include_partial('job/list', array('jobs' => $category->getActiveJobs())) ?>
    <?php if ($pager->haveToPaginate()): ?>
        <div class="pagination">
            <a  class="btn" href="<?php echo url_for('category', $category) ?>?page=1">
                <i class="fa fa-angle-double-left"></i>
            </a>

            <a  class="btn" href="<?php echo url_for('category', $category) ?>?page=<?php echo $pager->getPreviousPage() ?>">
                <i class="fa fa-angle-double-left"></i>
            </a>

            <?php foreach ($pager->getLinks() as $page): ?>
                <?php if ($page == $pager->getPage()): ?>
                    <?php echo $page ?>
                <?php else: ?>
                    <a class="btn" href="<?php echo url_for('category', $category) ?>?page=<?php echo $page ?>"><?php echo $page ?></a>
                <?php endif; ?>
            <?php endforeach; ?>

            <a class="btn" href="<?php echo url_for('category', $category) ?>?page=<?php echo $pager->getNextPage() ?>">
                <i  class="fa fa-angle-double-right"></i>
            </a>

            <a class="btn" href="<?php echo url_for('category', $category) ?>?page=<?php echo $pager->getLastPage() ?>">
                <i class="fa fa-angle-double-right"></i>
            </a>
        </div>
    <?php endif; ?>

    <div class="pagination_desc">
        <strong><?php echo count($pager) ?></strong> jobs in this category

        <?php if ($pager->haveToPaginate()): ?>
            - page <strong><?php echo $pager->getPage() ?>/<?php echo $pager->getLastPage() ?></strong>
        <?php endif; ?>
</table>