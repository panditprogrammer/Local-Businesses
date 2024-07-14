$(document).ready(function () {
    $('.share-button').on('click', async function () {
        let blogId = $(this).data("blogid");
        let url = "";
        if (blogId) {
            url = "/blog/" + blogId;
        } else {
            url = window.location.href;
        }


        try {
            if (navigator.share) {
                await navigator.share({
                    url: url
                });
            } else {
                const encodedUrl = encodeURIComponent(url);

                const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`;
                const twitterUrl = `https://twitter.com/intent/tweet?url=${encodedUrl}`;
                const linkedinUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodedUrl}`;

                $('#share-facebook').attr('href', facebookUrl);
                $('#share-twitter').attr('href', twitterUrl);
                $('#share-linkedin').attr('href', linkedinUrl);

                $('#share-links').show();
            }
        } catch (err) {
            console.error('Error sharing:', err);
        }
    });
});
