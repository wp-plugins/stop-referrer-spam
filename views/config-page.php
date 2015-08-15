<style type="text/css" xmlns="http://www.w3.org/1999/html">
    ul.wsrs__blacklist {
        display: none;
        list-style: decimal;
        width: 50%;
    }
    ul.wsrs__blacklist li {
        margin: 2px 2px 2px 30px;
        padding: 0;
    }
    ul.wsrs__blacklist li:nth-child(odd) {
        background-color: #efefef;
    }
</style>

<script>
    var wsrs__toggle = function () {
        var list = document.getElementsByClassName('wsrs__blacklist')[0],
            toggleBtn = document.getElementById('wsrs__toggle');
        if (list.style.display == 'block') {
            list.style.display = 'none';
            toggleBtn.text = 'expand';
        } else {
            list.style.display = 'block';
            toggleBtn.text = 'collapse';
        }
    }
</script>

<h2>Stop Referral Spam</h2>

<h3>Information</h3>

<?php if (isset($data['message'])): ?>
    <p><strong><?php echo $data['message'] ?></strong></p>
<?php endif; ?>
<p>
    List is updated twice a day. Next update is scheduled @ <?php echo WSRS_Helper::getNextUpdateTime(true) ?><br />
    <a href="<?php echo WSRS_Helper::url(array('force_refresh' => 1)) ?>">Refresh now</a>
</p>

<h3>Current blacklist sources:</h3>
<p>
    &gt; <a href="<?php echo WSRS_Config::WSRS_BLACKLIST_SOURCE_WEBSITE ?>" target="_blank">Piwik's referrer-spam-blacklist</a><br />
</p>
<h3>Current blacklist: <a id="wsrs__toggle" href="javascript:wsrs__toggle();">expand</a></h3>
<ul class="wsrs__blacklist">
    <?php foreach($data['blacklist'] as $blacklistedDomain): ?>
        <li><?php echo $blacklistedDomain ?></li>
    <?php endforeach ?>
</ul>


