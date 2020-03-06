# Test of Raspberry Pi 5 cluster

- Based on [edgelab.digital](https://github.com/digitalrebar/edgelab)

## Power setup
1. 3.0A for Raspberry Pi 4 Model B (2.5A for B+) [pi-power](https://www.raspberrypi.org/documentation/faqs/#pi-power)
2. 60W = 3A x 5V x 4 rpi4 5V Power source for stack
3. 20A @ 5V so an old PC ATX Power supply would work.

## Mechanical setup
1. Use a [4 cluster case](https://www.amazon.com/gp/product/B07CTG5N3V/ref=ppx_yo_dt_b_asin_title_o00_s00?ie=UTF8&psc=1)
2. Use a [8 port TPLink TL-SG108E](https://www.amazon.com/gp/product/B00K4DS5KU/ref=ppx_yo_dt_b_search_asin_title?ie=UTF8&psc=1)

## Schematics
![](ATX-BenchSupply-Diagram-1.png)
![](ATX-BenchSupply-Diagram-2.png)
![](ATX-BenchSupply-Pinout-1.png)
![](ATX-BenchSupply-Pinout-2.png)

## Notes:
- [CircuitPython](https://en.wikipedia.org/wiki/CircuitPython)
- [LiPo SHIM rpi lithuium ion battery pack shim](https://shop.pimoroni.com/products/lipo-shim)
- [ATX Standards](https://en.wikipedia.org/wiki/Power_supply_unit_(computer))
- [ATX Bench Supply Tutorial](https://www.youtube.com/watch?v=n_A-jkpjpcM)
   - [ATX Power Supply pinout](https://youtu.be/n_A-jkpjpcM?t=768)
   - [Patch Panel wire diagram](https://youtu.be/n_A-jkpjpcM?t=1360)
   - [Volt Amp Meter wire diagram](https://youtu.be/n_A-jkpjpcM?t=2157)
- [ATX Power Supply](https://www.youtube.com/watch?v=UiaqnFYK6SE)
- [Andreas Spiess YouTube](https://www.youtube.com/channel/UCu7_D0o48KbfhpEohoP7YSQ/videos)
   - [RPi4 SSD Boot](https://www.youtube.com/watch?v=gp6XW-fGVjo)
   - [RPi Docker Setup](https://www.youtube.com/watch?v=a6mjt8tWUws)
   - [WiFi Antennas Long-Range Mode - Part1](https://www.youtube.com/watch?v=2rujjTOPIRU)
   - [WiFi Antennas Long-Range Mode - Part2](https://www.youtube.com/watch?v=PUppoaePi3A)
   - [WiFi Antennas Optimization with N1201SA VNA](https://www.youtube.com/watch?v=ZpKoLvqOWyc)
   - [Amazon - N1201SA VNA](https://www.amazon.com/KKmoon-137-5MHz-2-7GHz-Measuring-Instrument-Impedance/dp/B081SVYMPZ/ref=sr_1_fkmr1_2?keywords=N1201A+Vector+Impedance+Analyzer&qid=1583439104&sr=8-2-fkmr1)
- [MotionEyeOS - Surveillance RPi](https://www.youtube.com/watch?v=NbFruaDUKB0)
- [RPi4 V1.1 vs V1.2 Power H/W Issue](https://www.youtube.com/watch?v=_wt9NTa1UNE)
   
### My issues with edgelab-demo
- [EEProm on fresh rpi4](https://github.com/digitalrebar/edgelab/issues/9)
- [Missing rpi4 iso on default](https://github.com/digitalrebar/edgelab/issues/10)
