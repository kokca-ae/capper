$(document).ready(function () {

    var ua = detect.parse(navigator.userAgent);
    $("html").addClass(ua.device.type + " " + ua.device.family + " " + ua.os.family + " " + ua.browser.family)

    $(".menuBtn").on("click", function () {
        $(".siteMenu").slideToggle(300)
    })

    if ($(".selectricBl").length > 0) {
        $('.selectricBl').map(function () {
            $('.selectricBl').selectric();
        })
    }

    if ($('.showEl').length > 0)
        $('.showEl').addClass("hidden").viewportChecker({
            classToAdd: 'visible animated fadeInDown', // Class to add to the elements when they are visible
            offset: 400
        });

    if ($('#grafabout').length > 0)
        Highcharts.chart('grafabout', {
            chart: {
                type: 'column',
                backgroundColor: 'transparent',
                height: window.outerWidth > 767
                    ? 360
                    : 200,
            },
            title: {
                text: ''
            },
            yAxis: {
                allowDecimals: false,
                min: 0,
                title: {
                    text: ''
                }
            },
            legend: {
                enabled: false
            },
            credits: {
                enabled: false,
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr'],
                gridLineWidth: 1,
                tickWidth: 0,
            },

            plotOptions: {
                series: {
                    borderWidth: 0,
                    pointPadding: 0
                }
            },
            colors: ['#f411aa', '#a801d4'],
            series: [{
                name: 'John',
                data: [250, 400, 800, 1000],
            }, {
                name: 'Joe',
                data: [500, 600, 650, 300],
            }]
        });


    if ($('#rev .revWall').length > 0 && $(window).width() > 767) {
        var rev = new Freewall('#rev .revWall');
        rev.reset({
            selector: '.revItem',
            cellW: function (width) {
                var cellWidth = width / 2;
                return cellWidth;
            },
            gutterX: 40,
            gutterY: 40,
            onResize: function () {
                rev.refresh();
            }
        });
        rev.fitWidth();
        setTimeout(function () { rev.refresh(); }, 300)
    }

    if ($('#video .revWall').length > 0 && $(window).width() > 767) {
        var video = new Freewall('#video .revWall');
        video.reset({
            selector: '.revItem',
            cellW: function (width) {
                var cellWidth = width / 2;
                return cellWidth;
            },
            gutterX: 40,
            gutterY: 40,
            onResize: function () {
                video.refresh();
            }
        });
        video.fitWidth();
        setTimeout(function () { video.refresh(); }, 300)
    }

    if ($(".tabs").length > 0) {
        $(".tabs").tabs({
            beforeActivate: function (event, ui) {
                if (ui.newPanel.find('.owl-carousel').length > 0) {
                    var el = ui.newPanel.find('.owl-carousel .item')
                    el.hide()
                }
            },
            activate: function (event, ui) {
                if (ui.newPanel.find('.owl-carousel').length > 0) {
                    var el = ui.newPanel.find('.owl-carousel .item')
                    el.delay(300).fadeIn(500)
                }
                if ($('#video .revWall').length > 0)
                    video.refresh();
                if ($('#rev .revWall').length > 0)
                    rev.refresh();
            },
            show: 'fadeIn',
            hide: 'fadeOut',
        });
    }

    if ($(".tabs").length > 0) {
        $('.dial').map(function () {
            $(".dial").knob({
                width: 100,
                height: 100,
                thickness: 0.5,
                inputColor: "#fff",
                readOnly: true
            });
        })
    }

    $('.copyLinkBoard').map(function () {
        new ClipboardJS('.copyLinkBoard');
    })

    if ($(".carouselRev").length > 0) {
        $('.carouselRev').map(function () {
            $(this).owlCarousel({
                dots: true,
                center: true,
                items: 3,
                loop: true,
                margin: 189,
                responsive: {
                    992: {
                        items: 3
                    },
                    0: {
                        items: 1
                    }
                }
            });
        })
    }

    $(".menuButton").click(function () {
        if ($(this).hasClass("selected")) {
            $(".menulk").slideUp().removeClass("open");
        } else {
            $(".menulk").slideDown().addClass("open");
        }
        $(this).toggleClass("selected");
    });

    if ($('.burger').length > 0) {
            $(".lk .burger").on('click', function () {
                if ($(".leftMenu").hasClass('active')) {
                    $(".leftMenu").stop().slideUp().removeClass('active');
                } else {
                    $(".leftMenu").stop().slideDown().addClass('active');
                    $('body').off('click')
                }
            });
    }

    /*
	var grafItems = [
        {
            date: '02.10.2019',
            percent: 1.5
        },
        {
            date: '02.10.2019',
            percent: 4.9
        },
        {
            date: '02.10.2019',
            percent: 4.2
        },
        {
            date: '02.10.2019',
            percent: 5.0
        },
        {
            date: '02.10.2019',
            percent: 5.9
        },
        {
            date: '02.10.2019',
            percent: -7.0
        },
        {
            date: '02.10.2019',
            percent: 8.7
        },
        {
            date: '02.10.2019',
            percent: 9.5
        },
        {
            date: '02.10.2019',
            percent: 12.7
        },
        {
            date: '02.10.2019',
            percent: 14.9
        },
        {
            date: '02.10.2019',
            percent: 3.9
        },
        {
            date: '02.10.2019',
            percent: 30.0
        },
    ]

    buildGraf(".returtGraf", grafItems)
	*/

    if ($(".slideTitle").length > 0) {
        $(".slideTitle").on('click', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active').siblings('.slideContent').stop().slideUp();
            } else {
                $(this).parents('.faqItem').siblings('.faqItem').find('.slideTitle.active').removeClass('active').siblings('.slideContent').stop().slideUp();
                $(this).addClass('active').siblings('.slideContent').stop().slideDown();
            }
        })
    }

    openMod()


    if ($("#globus").length > 0) {

        // globis -----------------------------
        var canvas = document.createElement('canvas');
        document.getElementById('globus').appendChild(canvas);
        canvas.id = "canvas";
        var ctx = canvas.getContext("2d");
        var spheres = [];
        var imgdata = [];
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        var imgWidth = 100;
        var imgHeight = 50;
        var screenX = canvas.width / 2;
        var screenY = canvas.height / 2;
        var screenScale = 1000;
        var rotation = 0;
        var isReadyAnimation = false;

        var Vector = function (x, y, z) {
            this.x = x;
            this.y = y;
            this.z = z;
        }

        var Particle = function (x, y, z, colorsArrIndex) {
            this.pos = new Vector(x, y, z);
            this.posModel = new Vector(x, y, z);
            this.GenerateColorFromImgIndex(colorsArrIndex);
        }


        Particle.prototype.GenerateColorFromImgIndex = function (i) {
            this.r = 244 - imgdata[i * 4 + 0];
            this.g = 17 - imgdata[i * 4 + 1];
            this.b = 170 - imgdata[i * 4 + 2];
            this.a = 0;
        }

        var Sphere = function (x, y, radius, numPointsX, numPointsY) {
            this.pos = new Vector(x, y, 1);
            this.particles = [];
            this.GeneratePoints(x, y, radius, numPointsX, numPointsY);
        }

        function CreateColorsArr() {
            var canvasimg = document.createElement('canvas');
            var ctximg = canvasimg.getContext("2d");
            var img = new Image();
            img.crossOrigin = "";
            img.src = "https://ucarecdn.com/684548ca-0157-4455-9fe5-9782af655cf0/worldmapsmall_bw9sas.png";
            var ctximg = canvasimg.getContext("2d");
            img.onload = function () {
                ctximg.translate(imgWidth, imgHeight);
                ctximg.scale(-1, -1);
                ctximg.drawImage(img, 0, 0);
                imgdata = ctximg.getImageData(0, 0, imgWidth, imgHeight).data;
                ctximg.clearRect(0, 0, imgWidth, imgHeight);
                spheres.push(new Sphere(0, 0, canvas.height / 4, imgWidth, imgHeight));
                isReadyAnimation = true;
            }
        }

        Sphere.prototype.GeneratePoints = function (x, y, radius, num, num2) {
            x = x / 2;
            y = y / 2;
            num = Math.floor(num);
            var angle = 2 * Math.PI / num;
            var angle2 = Math.PI / num2;
            for (var j = 0; j <= num2; j++) {
                for (var i = 0; i < num; i++) {
                    var rx = radius * Math.cos(angle * i) * Math.sin(angle2 * j);
                    var rz = radius * Math.sin(angle * i) * Math.sin(angle2 * j);
                    var ry = radius * Math.cos(angle2 * j);
                    this.particles.push(new Particle(x + rx, y + ry, rz, j * imgWidth + i));
                }
            }
        }

        Sphere.prototype.RotateAxisY = function (angle) {
            for (var i = 0; i < this.particles.length; i++) {
                this.particles[i].posModel.x = this.particles[i].pos.x * Math.cos(angle) + this.particles[i].pos.z * (-1) * Math.sin(angle);
                this.particles[i].posModel.y = this.particles[i].pos.y;
                this.particles[i].posModel.z = this.particles[i].pos.x * Math.sin(angle) + this.particles[i].pos.z * Math.cos(angle);
            }
        }

        Sphere.prototype.Draw = function (ctx) {
            ctx.beginPath();
            for (var i = 0; i < this.particles.length; i++) {
                var z = this.particles[i].posModel.z;
                var x = this.particles[i].posModel.x * screenScale / (z * (-1) + screenScale) + screenX;
                var y = this.particles[i].posModel.y * screenScale / (z * (-1) + screenScale) + screenY;;
                var a = (this.particles[i].posModel.z + (imgWidth / 2)) / imgWidth;
                if (a > 0.2) {
                    ctx.fillStyle = 'rgb(221, 218, 240)';
                    if (this.particles[i].r < 256 && this.particles[i].r >= 0) {
                        if (this.particles[i].g < 256 && this.particles[i].g >= 0) {
                            if (this.particles[i].b < 256 && this.particles[i].b >= 0) {
                                ctx.fillStyle = "rgba(" + this.particles[i].r + "," + this.particles[i].g + "," + this.particles[i].b + "," + a + ")";
                            }
                        }
                    }
                    ctx.fillRect(this.pos.x + x, this.pos.y + y, 2, 2);
                }
            }
        }

        function loop() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            if (isReadyAnimation) {
                spheres[0].Draw(ctx);
                spheres[0].RotateAxisY(rotation);
                rotation += 0.05;
            }
            requestAnimationFrame(loop);
        }
        CreateColorsArr();
        loop();
        // /globus---------------------------------------

    }

    if ($("#graph-measurement").length > 0) {
        // graf-----------------------------------------
        setTimeout(function () {
            var container = document.getElementById('container');
            var graphMeasurement = document.getElementById('graph-measurement');

            var allCircles = document.getElementsByTagName('circle');
            var allLines = document.getElementsByTagName('line');

            //console.log(topSVGNode)

            var destArray = [15, 52, 28, 170, 105, 93, 44, 122, 179, 170, 220];


            TweenMax.set(allCircles, {
                attr: { r: 5 },
                transformOrigin: '50% 50%',
                scale: 0
            })
            TweenMax.set([allLines], {
                attr: {},
                drawSVG: '100% 100%',
                strokeWidth: 2
            })
            TweenMax.set([graphMeasurement], {
                attr: {},
                drawSVG: '100% 100%',
                strokeWidth: 1
            })

            TweenMax.set([allCircles, allLines], {
                y: '+=300'
            })

            TweenMax.set(graphMeasurement, {
                y: '+=280',
                alpha: 0.3
            })
            TweenMax.to(graphMeasurement, 3, {
                drawSVG: '0% 100%',
                delay: 1,
                ease: Power2.easeInOut
            })
            TweenMax.set('svg', {
                alpha: 1
            })
            for (var i = 0; i < allCircles.length; i++) {

                TweenMax.to(allCircles[i], 2, {
                    attr: { cy: '-=' + destArray[i] },
                    onUpdate: moveLines,
                    onUpdateParams: [i],
                    delay: i / 5,
                    ease: Power4.easeInOut
                })
                if (allLines[i]) {

                    TweenMax.to(allLines[i], 1, {
                        drawSVG: '400',
                        delay: i / 5,
                        ease: Power4.easeInOut
                    })
                }

                TweenMax.to(allCircles[i], 1, {
                    scale: 1,
                    delay: i / 5,
                    ease: Power4.easeInOut
                })

            }

            function moveLines(i) {

                if (allLines[i]) {

                    TweenMax.set(allLines[i], {
                        attr: {
                            x2: allCircles[i].getAttribute('cx'), y2: allCircles[i].getAttribute('cy')
                        }
                    })
                    TweenMax.set(allLines[i], {
                        attr: {
                            x1: allCircles[i + 1].getAttribute('cx'), y1: allCircles[i + 1].getAttribute('cy')
                        }
                    })


                }
            }
        }, 0);
        // /graf-------------------------------------------
    }
    // openModal($('[data-modal="logReg"][data-tab="#reg"]'))
})
var buildGraf = function (el, data) {
    var vals = getVals(data)
    $(el).html("")
    data.map((item, index) => {
        var headTitle = '',
            footTitle = ''

        if (item.percent > 0) {
            headTitle = item.percent + "%"
        } else {
            footTitle = item.percent + "%"
        }
        var topClass = item.percent == vals.max ? " top" : ""
        var graf = item.percent > 0
            ? '<div class="grafUp' + topClass + '"><div class="in"></div></div>'
            : '<div class="grafDown"><div class="in"></div></div>'

        $(el).append('<div class="grafCell">' +
            '<span class="headTitle' + topClass + '">' + headTitle + '</span>' +
            '<span class="footTitle' + topClass + '">' + footTitle + '</span>' +
            '<span class="date">' + item.date + '</span>' +
            graf +
            '</div>')
        var graf = item.percent > 0
            ? $(el).find(".grafCell:last-child [class*='graf'] .in").attr({ 'data-height': item.percent * 100 / vals.max + '%' })
            : $(el).find(".grafCell:last-child [class*='graf'] .in").attr({ 'data-height': item.percent * 100 / vals.min + '%' })

    })
    var e = 0;
    $(window).on("scroll", function () {
        var w = $(window).scrollTop()
        var wH = $(window).outerHeight()
        var elT = $(el).offset().top
        var elH = $(el).outerHeight()

        var m = w, n = elT - wH / 2
        var m1 = w, n1 = elT + elH - wH / 2
        if (m > n && m1 < n1) {
            $(el + " .grafCell:not('.done')").map(function () {
                var h = $(this).find(".in").attr("data-height")
                $(this).find(".in").delay(e).animate({ height: h }, 500)
                $(this).addClass('done')
                e = parseInt(e) + 50
            })
        }
    })
}

var getVals = function (grafItems) {
    var max = grafItems[0].percent, min = grafItems[0].percent
    grafItems.map((item, index) => {
        if (item.percent > max) {
            max = item.percent
        }
        if (item.percent < min) {
            min = item.percent
        }
    })
    return { max: max, min: min }
}


