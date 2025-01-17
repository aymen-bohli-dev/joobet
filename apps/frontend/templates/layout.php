<!-- apps/frontend/templates/layout.php -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title> <?php if (!include_slot('title')) : ?>
            Jobeet - Your best job board
        <?php endif ?></title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="alternate" type="application/atom+xml" title="Latest Jobs" href="<?php echo url_for('job', array('sf_format' => 'atom'), true) ?>" />
</head>

<body>
    <div id="container">
        <div id="header">
            <div class="content">
                <h1><a href="<?php echo url_for('job/index') ?>">
                        <img src="/legacy/images/logo.jpg" alt="Jobeet Job Board" />
                    </a></h1>

                <div id="sub_header">
                    <div class="post">
                        <h2>Ask for people</h2>
                        <div>
                            <a href="<?php echo url_for('@job_new') ?>">Post a Job</a>
                        </div>
                    </div>

                    <div class="search">
                        <h2>Ask for a job</h2>
                        <form action="<?php echo url_for('job_search') ?>" method="get">
                            <input type="text" name="query" value="<?php echo $sf_request->getParameter('query') ?>" id="search_keywords" />
                            <input type="submit" value="search" />
                            <div class="help">
                                Enter some keywords (city, country, position, ...)
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="job_history">
            Recent viewed jobs:
            <ul>
                <?php foreach ($sf_user->getJobHistory() as $job) : ?>
                    <li>
                        <?php echo link_to($job->getPosition() . ' - ' . $job->getCompany(), 'job_show_user', $job) ?>
                    </li>
                <?php endforeach ?>

            </ul>
        </div>
        <div id="content">
            <?php if ($sf_user->hasFlash('notice')) : ?>
                <div class="flash_notice">
                    <?php echo $sf_user->getFlash('notice') ?>
                </div>
            <?php endif ?>

            <?php if ($sf_user->hasFlash('error')) : ?>
                <div class="flash_error">
                    <?php echo $sf_user->getFlash('error') ?>
                </div>
            <?php endif ?>

            <div class="content">
                <?php echo $sf_content ?>
            </div>
        </div>

        <div id="footer">
            <div class="content">
                <span class="symfony">
                    <img src="/legacy/images/jobeet-mini.png" />
                    powered by <a href="/">
                        <img src="/legacy/images/symfony.gif" alt="symfony framework" />
                    </a>
                </span>
                <ul>
                    <li><a href="#">About Jobeet</a></li>
                    <li class="feed"><a href="<?php echo url_for('job', array('sf_format' => 'atom')) ?>">Full feed</a></li>
                    <li><a href="#">Jobeet API</a></li>
                    <li class="last">
                        <a href="<?php echo url_for('affiliate_new') ?>">Become an affiliate</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.2.6/jquery.min.js" integrity="sha256-1UhTB3WmKG9JumbgcVh2tOxZhZZrApHCFWj+z8QXjo0=" crossorigin="anonymous"></script>
    <?php use_javascript('search.js') ?>
    <?php include_javascripts() ?>
</body>
</html>