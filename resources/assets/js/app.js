require('./bootstrap');
require('axios');

const App = {
    vote: {
        up(event, story, user) {
            axios.put(`/stories/${story}/vote/up`, { user }).then((res) => {
                if (res.data.status === 'success') {
                    const vote = parseInt(res.data.data.upvote_count, 10) - parseInt(res.data.data.downvote_count, 10);
                    const voting = $(event.target).closest('.voting');

                    voting.find('.votes').text(vote);
                    voting.find('.upvote').text(`upvoted (${parseInt(res.data.data.upvote_count, 10)})`);
                    voting.find('.upvote').addClass('disabled');
                }
            });
        },

        down(event, story, user) {
            axios.put(`/stories/${story}/vote/down`, { user }).then((res) => {
                if (res.data.status === 'success') {
                    const vote = parseInt(res.data.data.upvote_count, 10) - parseInt(res.data.data.downvote_count, 10);
                    const voting = $(event.target).closest('.voting');

                    voting.find('.votes').text(vote);
                    voting.find('.downvote').text(`downvoted (${parseInt(res.data.data.downvote_count, 10)})`);
                    voting.find('.downvote').addClass('disabled');
                }
            });
        },
    },

    comment: {
        replyFor(e, comment) {
            const form = $('#new-comment').find('form');
            if (form.find('input[name=reply_id]').length) {
                form.find('input[name=reply_id]').remove();
            }
            form.prepend(`<input type="hidden" name="reply_id" value="${comment}" />`);
        }
    },
};

(($) => {

    const upvoteButton = $('.upvote');
    upvoteButton.on('click', (e) => {
        e.preventDefault();

        App.vote.up(e, $(e.target).data('story'), $(e.target).data('user'));
    });

    const downvoteButton = $('.downvote');
    downvoteButton.on('click', (e) => {
        e.preventDefault();

        App.vote.down(e, $(e.target).data('story'), $(e.target).data('user'));
    });

    const replyButton = $('.reply[data-reply-id]');
    replyButton.on('click', (e) => {
        App.comment.replyFor(e, $(e.target).data('reply-id'));
    });

})(jQuery);
