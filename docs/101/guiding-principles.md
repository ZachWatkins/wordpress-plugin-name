# Guiding Principles of Software Development

"Great things are not done by impulse, but by a series of small things brought together." - Letter to Theo (October 1882) *Vincent Van Gogh*

These principles can be searched for a far better explanation than what is provided here, but even so my thoughts and noteworthy sources are provided here as a suggestion for self-guided learning.

1. Don't Repeat Yourself
2. Separation of Concerns
3. Single Responsibility Principle
4. Avoid clever code (prefer simple, intuitive logic)
5. Avoid early optimization

## Don't Repeat Yourself

If you plan to re-use code you have created, try to package it so that you can call upon it as a reference instead of needing to copy and paste the code again in a different file. This will help with the maintainability of that code and wherever it will be used.

## Separation of Concerns

This is a key principle of software development and involves separating code in a logical way for the purpose of reducing the burden required to maintain it. How or why to separate code is subjective and while there are best practices and standards it is ultimately up to the maintainers. The number of files may seem intimidating until you remember this is done with the goal of adding simplicity, not taking away from it.

"[Separation of Concerns], even if not perfectly possible, is yet the only available technique for effective ordering of one's thoughts, that I know of." -- Edsger W. Dijkstra

## Single Responsibility Principle

"It is a software engineering principle that states that a class should have only one reason to change. In other words, it must have only one responsibility.

"Here, we are talking about cohesion. All elements in given class structures or modules should have a functional affinity to one another. By clearly defining your class’s responsibility, you increase its cohesiveness."

- Jerome Rault, "10 Crucial Software Development Principles to Live By", <https://www.laneways.agency/software-development-principles/>

## Principle of Least Privilege

Grant a 
