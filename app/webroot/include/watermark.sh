#!/bin/sh

ffmpeg -i $1 -vf "movie=A-Watermark.png,scale=$3:$3 [watermark]; [in][watermark] overlay=10:10 [out]" $2 & 

