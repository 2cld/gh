# Blender 
Blender infrastructure and workflow support documentation.  [Edit this](https://github.com/2cld/gh/edit/master/docs/blender/README.md)

## Quick Links
- [Blender Cheatsheet 0v1.pdf](./Blender%20Cheatsheet%20v1.pdf)

## CAToDo
- [blender/architecture](./architecture/) Setup for achitecture drawing in blender
- [blender/architecture/catArchModelNotes](./architecture/catArchModelNotes) Chris notes as he learns blender architecture cad
- [blender/tutorial/learn-bg-anvil](./tutorial/learn-bg-anvil) Chris notes as he builds an anvil for an nft project
- [blender/](./blender-create-shelf) Chris creates shelf for data center airflow issue
- [tbd]()
- [tbd]()
- [tbd]()


## Reminder - Infrastructure
Blender test machine is on the ghadmin - horseoff [network](https://my.zerotier.com/network/d5e5fb65371eb4a4) using windows 10 machines on bare metal (see ebay for the parts you got 2020.06.07)

### catghwin10
- Device name: catghwin10
- CPU: 2 x Intel Xeon E5472 3GHz
- RAM: 32GB
- OS: Windows 10 Pro - 1903 (build 18362.900) - Installed 6/11/2020

## References
- Learning Architecture Drawing with Blender [https://www.blender3darchitect.com/course/blender-basics-architecture/](https://www.blender3darchitect.com/course/blender-basics-architecture/)
- Arch Blender [Dimensions](https://www.blender3darchitect.com/modeling-for-architecture/architectural-modeling-how-to-display-lengths-in-blender-2-8/)
- Blender [100 Blender 2.8 tips with index](https://www.youtube.com/watch?v=_9dEqM3H31g)
- Blender [Create Shelf](https://www.youtube.com/watch?v=OOBKo-O6i_8&feature=youtu.be&t=27)
- Blender [aur blender shelf](https://www.youtube.com/watch?v=ElGc34VtoA4)
- Blender [Learning Blender 2023 tutorial reviews](https://www.youtube.com/watch?v=8K4AShjq-MU)
- Blender [I wish I knew before starting to learn blender](https://www.youtube.com/watch?v=m6U09BKETHY)
- Blender [tips youtube](https://www.youtube.com/watch?v=4YDf_ctubbI)
- [BlenderBIM](../bim/)
- BlenderBIM [IFC Architect](https://www.youtube.com/@IfcArchitect/videos)
- BlenderBIM [IFC Architect - Begin](https://www.youtube.com/watch?v=kF2k_VW-yrQ)
- BlenderBIM [https://blenderbim.org](https://blenderbim.org/index.html)
- BlenderBIM [https://ifcopenshell.org/](https://ifcopenshell.org/)
- BlenderBIM [Add on - youtube](https://www.youtube.com/watch?v=kYs6w5LlfNM)
- BlenderBIM [update - youtube](https://www.youtube.com/watch?v=oljVAjW9QVw)

## Precision Transformations
1. Object Transform
  - Location
  - Rotation
  - Scale
  - G X 4 <return> - Will translate the object 4 units in the x direction
  - Alt-G will clear translate
  - R X 45 <return> - Will rotate the object 45 degrees in the x direction
  - Alt-R will clear rotate
  - S Z 2 <return> - will double the size in the z direction
2. Setting up units
  - Blender unit is 1 meter
  - Scene tab -> Units -> Dropdown to select the blender units
3. Basic Object
  - Select Edit Mode
  - Select edge
  - Move edge
  - Select face
  - Use tab to toggle between object and edit modes
  - Extrude
    - Select face by right clicking on dot in edit mode
    - E then move or type num value to extrude
    - Click left mouse to finish
  - Loop cut
    - Cntl-R put mouse over edge move along edge click left button
4. Create new object
  - Add -> Mesh (or Shift-A) -> Select your Mesh object
  - Objects are created at the 3D cursor
  - Shift-C will put the cursor back at origin of 3D view
5. Basic Wall
  - Shift-A -> Plane
  - Scale to wall thickness
  - Ctrl-A -> Scale (to apply scale to object which sets base unit)
  - Edit mode, select edge, extrude x 5 return
  - Edit mode, select edge, extrude y -4 return
  - Edit mode, select 3 faces, hold shift and right click on all
  - E 3 <return>

### Blender 2.8 Fundamentals [List of 48 Blender Foundation Videos](https://www.youtube.com/playlist?list=PLa1F2ddGya_-UvuAqHAksYnB0qL9yWDO6)
1. First Steps [Blender 2.80 Fundamentals 1](https://www.youtube.com/watch?v=MF1qEhBSfq4&list=PLa1F2ddGya_-UvuAqHAksYnB0qL9yWDO6&index=2&t=0s)
2. Viewport Navigation [Blender 2.80 Fundamentals 2](https://www.youtube.com/watch?v=ILqOWe3zAbk&list=PLa1F2ddGya_-UvuAqHAksYnB0qL9yWDO6&index=2)
    - 3D-Viewport Select [Video](https://youtu.be/ILqOWe3zAbk?list=PLa1F2ddGya_-UvuAqHAksYnB0qL9yWDO6&t=10)
      - Left Click to select, Left click blank space to deselect 
      - A to select ALL, Alt-A to deselect all 
      - Change button functions in Edit -> Preferences -> Keymap 
    - Pan and Zoom [Video](https://youtu.be/ILqOWe3zAbk?list=PLa1F2ddGya_-UvuAqHAksYnB0qL9yWDO6)
      - Upper Right of view Click on X, Y, Z to get orthographic
      - Click and Drag X, Y, Z to rotate OR Middle Mouse Click and Drag
      - Click Hand Icon and Drag to where you want the scene to rotate around
      - View -> Frame Selected (Numpad .) zooms frame to selected object
      - Click Camera icon to view what the camera sees (Numpad 0)
      - Grid switches betwee Orthographic and Prospective modes
3. Interface Overview [Blender 2.80 Fundamentals 3](https://www.youtube.com/watch?v=8XyIYRW_2xk&list=PLa1F2ddGya_-UvuAqHAksYnB0qL9yWDO6&index=3)
    - Bottom of screen shows what the mouse buttons will do
    - You can scale panels by click and drag edges
    - Right click edge to create more or delete pannels
    - Cntl-Space will maximize a panel, Cntl-Space again will return max panel to original
    - Press T to bring up Tools menu, Press T again to hide Tools menu
    - Tools are Select box, Move, Rotate and Scale
    - Shift space will also bring up menu
    - Press N or left-click to open additional quick settings
    - Shift right-click to set position of 3D cursor
    - Shift S to bring up world pie menu
    - Bottom panel is Timeline mainly for animation
    - Right panel is Properies menu
    - Properties also contains object properies tab for each object in Scene
    - Create new scenes and switch senes in top menu dropdown
    - Tabs in Properties [Video](https://youtu.be/8XyIYRW_2xk?list=PLa1F2ddGya_-UvuAqHAksYnB0qL9yWDO6&t=303)
      - File - Render properties
      - Printer - Output properties
      - Image - View layer properties (separte layers for viewing and rendering)
      - General Scene - Active camera, units, ridge body settings
      - Globe tab - Sky and Air of scene
    - Tabs specific for Object selected [Video](https://youtu.be/8XyIYRW_2xk?list=PLa1F2ddGya_-UvuAqHAksYnB0qL9yWDO6&t=456)
      - Object - basic info about Location, rotation, scale of object, visiblity, parent-child relationships
      - Wrench - Modifiers icon for manipulation of pbject using predefines
      - Particles - 
      - Physics (Hydrogen) - Enable various physics properties and modify
      - Constrains - Like modifiers tab, but deals with relationships between modifiers
      - Mesh (green triangle) - object mesh data
      - Materials (sphere) - Apply materials to objects
    - Tab for Texture
    - Tab for Lamp (if light source is selected) - Modify light source
    - Tab for Camera (if camera is selected) - Modify camera properties
    - Scene collection (above properties)
4. Select and Transform [Blender 2.80 Fundamentals 4](https://www.youtube.com/watch?v=hTL6AKR8YDs&list=PLa1F2ddGya_-UvuAqHAksYnB0qL9yWDO6&index=4)
  - Left-Click object to select, Left-Click empty space to de-select
  - Select Box Tool in Tools (type T) Ctrl-Click to de-select
  - Circle Select (type C) acts as paint brush to select objects
  - Hold Shift and select objects to multiple select and de-select
  - Put in Wireframe mode (upper right) so you can select easier
  - Select menu also has all the above selection tools
  - Transform Tools [Video](https://youtu.be/hTL6AKR8YDs?list=PLa1F2ddGya_-UvuAqHAksYnB0qL9yWDO6&t=173)
    - Tools -> Move (Arrow out) 
      - Click Color Arrow to move on that axis
      - Click Color Plain to move on that plane
      - Hot key X, Y, Z contrains to that axis
      - Alt-G reset transformation
    - Tools -> Rotate (Arrows around)
      - Click color line to rotate about that axis
      - Outer white (spin around view axis)
      - Sphere white (3d sping around object origin) press R, then X, Y, Z to contrain and R again to go free
    - Tools -> Scale (Arrow out)
      - tbd
5. XXX [Blender 2.80 Fundamentals 5]()
6. XXX [Blender 2.80 Fundamentals 6]()
7. XXX [Blender 2.80 Fundamentals 7]()
8. XXX [Blender 2.80 Fundamentals 8]()
9. XXX [Blender 2.80 Fundamentals 9]()
10. XXX [Blender 2.80 Fundamentals 10]()
11. XXX [Blender 2.80 Fundamentals 11]()
12. XXX [Blender 2.80 Fundamentals 12]()
13. XXX [Blender 2.80 Fundamentals 13]()
14. XXX [Blender 2.80 Fundamentals 14]()
15. XXX [Blender 2.80 Fundamentals 15]()
16. XXX [Blender 2.80 Fundamentals 16]()
17. XXX [Blender 2.80 Fundamentals 17]()
18. XXX [Blender 2.80 Fundamentals 18]()
19. XXX [Blender 2.80 Fundamentals 19]()
20. XXX [Blender 2.80 Fundamentals 20]()
21. XXX [Blender 2.80 Fundamentals 21]()
22. XXX [Blender 2.80 Fundamentals 22]()
23. XXX [Blender 2.80 Fundamentals 23]()
24. XXX [Blender 2.80 Fundamentals 24]()
25. XXX [Blender 2.80 Fundamentals 25]()
26. XXX [Blender 2.80 Fundamentals 26]()
27. XXX [Blender 2.80 Fundamentals 27]()
28. XXX [Blender 2.80 Fundamentals 28]()
29. XXX [Blender 2.80 Fundamentals 29]()
30. XXX [Blender 2.80 Fundamentals 30]()
31. XXX [Blender 2.80 Fundamentals 31]()
32. XXX [Blender 2.80 Fundamentals 32]()
33. XXX [Blender 2.80 Fundamentals 33]()
34. XXX [Blender 2.80 Fundamentals 34]()
35. XXX [Blender 2.80 Fundamentals 35]()
36. XXX [Blender 2.80 Fundamentals 36]()
37. XXX [Blender 2.80 Fundamentals 37]()
38. XXX [Blender 2.80 Fundamentals 38]()
39. XXX [Blender 2.80 Fundamentals 39]()
40. XXX [Blender 2.80 Fundamentals 40]()
41. XXX [Blender 2.80 Fundamentals 41]()
42. XXX [Blender 2.80 Fundamentals 42]()
43. XXX [Blender 2.80 Fundamentals 43]()
44. XXX [Blender 2.80 Fundamentals 44]()
45. XXX [Blender 2.80 Fundamentals 45]()
46. XXX [Blender 2.80 Fundamentals 46]()
47. XXX [Blender 2.80 Fundamentals 47]()
48. XXX [Blender 2.80 Fundamentals 48]()
49. XXX [Blender 2.80 Fundamentals 49]()
  - xxx Some Subject [Video]()
    - xxx [Video]()
    - xxx [Video]()
    - xxx [Video]()
    - xxx [Video]()
    - xxx [Video]()

### Install Blender
1. tbd... link to other 
