<footer class="bg-dark text-gold p-3 shadow">
    <div class="text-center">
        <a class="<?= STYLE::FOOTER_LINK ?>" href="./about-us">About-us</a>
        -
        <a class="<?= STYLE::FOOTER_LINK ?>" href="./contact">CONTACT</a>
        -
        <a class="<?= STYLE::FOOTER_LINK ?>" href="<?= $SITE::INSTAGRAM ?>" target="blank"><?= ICON::INSTAGRAM ?></a>
        <a class="<?= STYLE::FOOTER_LINK ?>" href="<?= $SITE::FACEBOOK ?>" target="blank"><?= ICON::FACEBOOK ?></a>
        <a class="<?= STYLE::FOOTER_LINK ?>" href="<?= $SITE::TWITTER ?>" target="blank"><?= ICON::TWITTER ?></a>
    </div>
    <div class="text-center">
        <a class="<?= STYLE::FOOTER_LINK ?>" href="./faq">FAQ</a>
        -
        <a class="<?= STYLE::FOOTER_LINK ?>" href="./policy">Privacy Policy</a>
        -
        <a class="<?= STYLE::FOOTER_LINK ?>" href="./cgucgv">CGU/CGV</a>
        -
        <a class="<?= STYLE::FOOTER_LINK ?>" href="./sitemap">Sitemap</a>
    </div>
    <div class="text-center text-gold mt-2">
        <p class="<?= STYLE::FOOTER_LINK ?> h6">&copy; <?= $SITE->year() . ' ' . SITE::TITLE ?></p>
    </div>
</footer>

<script src="<?= SCRIPT::JQUERY ?>"></script>
<script src="<?= SCRIPT::JQUERY_VALIDATE ?>"></script>
<script src="<?= SCRIPT::BOOTSTRAP ?>"></script>
<script src="<?= SCRIPT::BOOTSTRAP_VALIDATOR ?>"></script>
<script src="<?= SCRIPT::FONTAWSOME ?>"></script>
<script src="<?= SCRIPT::REGEX ?><?= "?vr=0" ?>"></script>
<script src="<?= SCRIPT::SCRIPT ?><?= "?vr=0" ?>"></script>

<script src="<?= !empty($script) ? $script : "" ?>"></script>

</body>

</html>