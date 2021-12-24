$(document).ready(function() {

    // give all .svg fishes a random color
    $('.fish svg').each(function() {
        var randomColor = "#" + Math.floor(Math.random()*16777215).toString(16); // sweet mother of god
        $(this).css('fill', randomColor);
    });

    // set a random starting position for all fishes
    $('.fish').each(function() {
        var pos = getNewPos();
        
        $(this).css('left', pos[1]);
        $(this).css('top', pos[0]);
    });

    animateFish();
});

// generates a new random position for a fish within the aquarium's bounds
function getNewPos() {
    var h = $('#aquariumContainer').height() - 90;
    var w = $('#aquariumContainer').width() - 90;
    nh = Math.floor(Math.random() * h);
    nw = Math.floor(Math.random() * w);
    
    return [nh,nw];
}

// continually generate new random positions for each fish and
// animate their movements to those positions
function animateFish() {
    $('.fish').each(function() {
        var pos = getNewPos();
        var duration = Math.max(Math.random() * 8000, 5000);
        var delay = Math.max(Math.random() * 3000, 500);

        $(this).delay(Math.floor(Math.random() * 3000)).animate(
            { top: pos[0], left: pos[1] }, 
            {
                duration: duration,
                easing: "swing",
                complete:function() {
                    animateFish();
                }
            }
        )
    });
    
};
