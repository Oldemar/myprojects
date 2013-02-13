#!/bin/sh

ffmpeg -ss 5 -i $1 -y -vcodec mjpeg -vframes 15 -an -f rawvideo $2 &

