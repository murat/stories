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

})(jQuery);
