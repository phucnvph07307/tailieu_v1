var io = require("socket.io")(6001);
console.log("đang kết nối với port 6001");

io.on("error", socket => {
    console.log("error");
});

io.on("connection", socket => {
    console.log("Có người đang kết nối là : " + socket.id);
});

var Redis = require("ioredis");
var redis = new Redis(1000);
redis.psubscribe("*", function(error, count){});

redis.on("pmessage", function(partner, channel, message){
    console.log(partner);
    console.log(channel);
    console.log(message);

    message = JSON.parse(message);
    io.emit(channel+":"+message.event, message.data.message);
    console.log('Đã gửi đi');

});
