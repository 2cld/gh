# Create a simple shelf in Blender 2.8

## Shelf [Video](https://www.youtube.com/watch?v=OOBKo-O6i_8)
1. Open new Blender file and set to feet
  - Blender default unit is 1 meter
  - Properties -> Scene tab -> Units -> Dropdown to select the blender units Imperial
  - Verify Unit Scale: 1.0
  - Verify Length: Feet
2. Delete camera and light
  - LMB click light
  - RMB -> Select: Delete
  - Repeat for camera
3. Modify Box [Video](https://youtu.be/OOBKo-O6i_8?t=27)
    1. Move bottom face of box to z 0
      - LMB-Click z or type 7 on Numpad (top orth)
      - type 9 on Numpad (bottom face)
      - type Tab (switch to Edit Mode)
      - LMB-Click Face select
      - LMB-Click -> Select Bottom Face
      - type 1 on Numpad (front orth view)
      - type g z (grab move in z axis only) press cntrl and <up arrow> to z-0
      - press return (accept chagne)
    2. Move left face of box to x 0
      - LMB-Click x or type 3 on Numpad (side orth)
      - type 9 on Numpad (left face)
      - type Tab (switch to Edit Mode)
      - LMB-Click Face select
      - LMB-Click -> Select Left Face
      - type 7 on Numpad (top orth view)
      - type g x (grab move in x axis only) press cntrl and <right arrow> to x-0
      - press return (accept change)
    3. Move front face of box to y 0
      - LMB-Click x or type 1 on Numpad (side orth)
      - type Tab (switch to Edit Mode)
      - LMB-Click Face select
      - LMB-Click -> Select Front Face
      - type 7 on Numpad (top orth view)
      - type g y (grab move in y axis only) press cntrl and <up arrow> to y-0
      - press return (accept change)
    4. Should have a 1'x1'x1' cube with origin at bottom left front vertex
    5. Grab back face to get 1x1x4 box
      - LMB-Click x or type 1 the 9 on Numpad (back side)
      - type Tab (switch to Edit Mode)
      - LMB-Click Face select
      - LMB-Click -> Select Front Face
      - type 7 on Numpad (top orth view)
      - type g y (grab move in y axis only) press cntrl and <up arrow> to y-4
      - press return (accept change)
    6. Delete front and back faces
      - MMB-Rotate so you see the long box face
      - LMB-Click
      - RMB-Click Select Delete Faces
      - Repeate for other long face
    7. type Tab or Exit out of Edit Mode and go into Object Mode
4. Add Modifiers
    1. LMB-Click object
    2. Add Solidify modifier (wrench icon in properties tab)
      - LMB-Click Add Modifier
      - LMB-Click Solidify
      - Add thinkness 0.1ft
      - LMB-Click Apply
    3. Add Array modifier shelf (wrench icon in properties tab)
      - LMB-Click Add Modifier
      - LMB-Click Array
      - Add Count 10
      - Add Array in x 0, y 0, z 1
      - LMB-Click Apply
    4. Add Array modifier isle (wrench icon in properties tab)
      - LMB-Click Add Modifier
      - LMB-Click Array
      - Add Count 7
      - Add Array in x 0, y 1, z 0
      - LMB-Click Apply
    5. Add Array modifier grid (wrench icon in properties tab)
      - LMB-Click Add Modifier
      - LMB-Click Array
      - Add Count 6
      - Add Array in x 1, y 0, z 0
      - LMB-Click Apply
5. View and Save
  - Pan and admire
  - File -> Save As: blender-create-shelf.blend
  - Upload to this directory
