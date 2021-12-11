$(document).ready(function() {
    
    $('.fish').each(function() {
        var randomColor = "#" + Math.floor(Math.random()*16777215).toString(16); // sweet mother of god
        $(this).css('color', randomColor);
    })
    animateFish();
});

function getNewPos() {
    var h = $('#aquariumContainer').height() - 50 ;
    var w = $('#aquariumContainer').width() - 50;
    
    console.log($('#aquariumContainer').offset().top);

    nh = Math.floor(Math.random() * h) + $('#aquariumContainer').offset().top;
    nw = Math.floor(Math.random() * w) + $('#aquariumContainer').offset().left;
    
    return [nh,nw];
}

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
