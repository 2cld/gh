# Crowd-Render

- [Crowd-Render main site](https://www.crowd-render.com/ )
- [Crowd-Render YouTube videos](https://www.youtube.com/channel/UCo26vYNF6WzMuVM10xzO7sQ/videos)
- [Github (docker)](https://github.com/crowdrender/cr-docker)
- [Github (docker NVidia)]( https://github.com/NVIDIA/nvidia-docker )

## Setup
- [Quick Build | Making a render farm in Blender 2.81](https://www.youtube.com/watch?v=NLhdJ5a-jy4)

## Distributed Render setup
- [Crowd-Render -> Packing libraries and assets](https://youtu.be/ttZVSYKFcgE)
- [Explains External Data -> Automatically Pack into .blend](https://youtu.be/ttZVSYKFcgE?t=100) Warning: This does NOT pack Linked and Append files which is why it's an issue with distributed rendering
- [Explains Save As -> pack all .blend](https://youtu.be/ttZVSYKFcgE?t=257) 
- [Shows the hard to find command ](https://youtu.be/ttZVSYKFcgE?t=544)
   - Edit -> Search: "pack"
   - Select: "File: Pack Blender Libraries"
   - Save As: "whatever_pack_all_libs.blend"
   - Copy THAT blend file to distributed nodes
- Resync and render
