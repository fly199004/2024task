## SWEN90006 Assignment 1: Testing the Air Quality Management System

In this assignment, you will test a simplified Air Quality Management System
(AQMS) in which data is collected from a sensor network. The system allows
authenticated users and devices to upload and retrieve data. To enable these
features, the system implements functions for users to:

- register,
- log in, and
- add and read sensor data.



在此作业中，您将测试一个简化的空气质量管理系统 (AQMS)，其中数据是从传感器网络收集的。该系统允许经过身份验证的用户和设备上传和检索数据。为了启用这些功能，系统为用户实现了以下功能：

- 注册，

- 登录，

- 添加和读取传感器数据。

  

For simplicity, the system implements the database as a Java data structure.
We assume that the implementation has no security vulnerabilities, and all
these functions are intended for use by the administrators.

This assignment focuses on input partitioning, boundary-value analysis, control-flow testing,
and briefly touches on mutation analysis.

You are provided with the specification of the AQMS and its implementation as a Java
program. The program is organized into a folder containing multiple files that adhere to
the specification. Your task is to test the program using various techniques and analyze
the differences in the effectiveness of these methods.

While you will be deriving and comparing test cases, debugging the program is not required.
This assignment has both practical and analytical components. You will need to update the
provided templated JUnit driver program to run your test cases, which may require some
experimentation with the JUnit framework. Additionally, you will apply testing techniques
to derive your test cases and compare the results.

This assignment accounts for 20% of your final mark.



为简单起见，系统将数据库实现为 Java 数据结构。
我们假设实现没有安全漏洞，并且所有这些功能都供管理员使用。

此作业重点介绍输入分区、边界值分析、控制流测试，并简要介绍突变分析。

您将获得 AQMS 的规范及其作为 Java 程序的实现。该程序组织到一个文件夹中，其中包含多个符合规范的文件。您的任务是使用各种技术测试程序并分析这些方法的有效性差异。

虽然您将导出和比较测试用例，但不需要调试程序。
此作业既有实践部分，也有分析部分。您需要更新提供的模板化 JUnit 驱动程序以运行您的测试用例，这可能需要对 JUnit 框架进行一些实验。此外，您将应用测试技术来导出测试用例并比较结果。

此作业占您最终成绩的 20%。

### Project Structure and Build Instructions

The project is organized into key directories and files, each serving a specific
purpose:

- **`AQMSSpecs.txt`**: A text file detailing the specifications of the AQMS. You will
  use these specifications for testing techniques such as input partitioning and
  boundary-value analysis.
  
- **`programs/`**: Contains the Java source files that implement the AQMS as per
  the provided specifications (AQMSSpecs.txt). The `original/` subdirectory includes the necessary
  classes, such as `AQMS.java` and various exceptions. These files are the main
  focus for testing and will be compiled and executed.

- **`tests/`**: Contains the JUnit test scripts you'll work with. The `swen90006/aqms/`
  subdirectory includes test cases like `BoundaryTests.java` and `PartitioningTests.java`.
  Your task is to update and expand these tests to evaluate the AQMS implementation.

- **`build.xml`**: The Ant build file automates compiling the AQMS and running the
  JUnit tests. It includes targets for checking validity, compiling sources, running
  tests, and cleaning up files. Use this file to build and test the program.

- **`id.txt`**: A file for you to **write down your student ID**. Please replace the sample
  ID with your own, ensuring it includes **only your student ID**. The teaching team uses
  this to automatically mark your JUnit tests.

该项目分为几个关键目录和文件，每个目录和文件都有特定的用途：

- **`AQMSSpecs.txt`**：一个详细说明 AQMS 规范的文本文件。您将使用这些规范来测试输入分区和边界值分析等技术。

- **`programs/`**：包含根据提供的规范 (AQMSSpecs.txt) 实现 AQMS 的 Java 源文件。`original/` 子目录包含必要的类，例如 `AQMS.java` 和各种异常。这些文件是测试的主要焦点，将被编译和执行。

- **`tests/`**：包含您将使用的 JUnit 测试脚本。`swen90006/aqms/` 子目录包括测试用例，例如 `BoundaryTests.java` 和 `PartitioningTests.java`。您的任务是更新和扩展这些测试以评估 AQMS 实现。

- **`build.xml`**：Ant 构建文件自动编译 AQMS 并运行
JUnit 测试。它包括检查有效性、编译源、运行
测试和清理文件的目标。使用此文件构建和测试程序。

- **`id.txt`**：供您**记下学生 ID** 的文件。请将示例 ID 替换为您自己的 ID，确保其中**仅包含您的学生 ID**。教学团队使用
它自动标记您的 JUnit 测试。

The `lib/` directory contains the necessary libraries (`junit-4.11.jar`,
`hamcrest-core-1.3.jar`, and `commons-lang3-3.15.0.jar`) for running the tests, and
`classes/` stores the compiled Java classes, which are automatically generated during
the build process.

**Prerequisites:** Ensure that the following software is installed on your system:

- **Java Development Kit (JDK):** Java is required to compile and run the project. 
Ensure that the JDK is installed and that the `JAVA_HOME` environment variable 
is set correctly.

- **Apache Ant:** Ant is the tool used to automate the build process. 
You can install Ant using Homebrew `brew install ant` (for macOS users) or by downloading it 
from the official [Apache Ant website](https://ant.apache.org/).

- **Integrated Development Environment (IDE):** While any Java IDE works, 
**IntelliJ IDEA** is recommended for its robust support,
including Ant integration, code completion, and debugging tools.

`lib/` 目录包含运行测试所需的库（`junit-4.11.jar`、
`hamcrest-core-1.3.jar` 和 `commons-lang3-3.15.0.jar`），而 `classes/` 存储编译后的 Java 类，这些类在构建过程中自动生成。

**先决条件：**确保您的系统上安装了以下软件：

- **Java 开发工具包 (JDK)：**需要 Java 来编译和运行项目。

确保已安装 JDK 并且正确设置了 `JAVA_HOME` 环境变量。

- **Apache Ant：**Ant 是用于自动化构建过程的工具。

您可以使用 Homebrew `brew install ant`（适用于 macOS 用户）或从官方 [Apache Ant 网站](https://ant.apache.org/) 下载来安装 Ant。

- **集成开发环境 (IDE)**：虽然任何 Java IDE 都可以使用，但建议使用 **IntelliJ IDEA**，因为它具有强大的支持，
包括 Ant 集成、代码完成和调试工具。

**Build Instructions:** The `build.xml` file contains **targets** for tasks like compiling code (converting
Java source files into bytecode), running tests (verifying functionality), and
specifying configurations such as program version (`original` or `mutant`) and
test suite (`BoundaryTests` or `PartitioningTests`).

**构建说明**：`build.xml` 文件包含编译代码（将 Java 源文件转换为字节码）、运行测试（验证功能）等任务的**目标**，以及指定程序版本（`原始` 或 `突变`）和测试套件（`BoundaryTests` 或 `PartitioningTests`）等配置。

**Available Build Targets and their Usage:**

| Target Name    | Description                                                                               | Terminal Command                                                                           |
|----------------|-------------------------------------------------------------------------------------------|--------------------------------------------------------------------------------------------|
| `compile_orig` | Compiles the original program located in the `src/original/` directory.                   | `ant compile_orig`                                                                         |
| `compile_test` | Compiles the test cases located in the `src/tests/` directory. The test should match one of {PartitioningTests, BoundaryTests} (The same list applies to all `Dtest` options below)                           | `ant compile_test -Dtest='PartitioningTests'` OR <br>`ant compile_test -Dtest='BoundaryTests'` |
| `check_prog`   | Validates that a program is specified and checks if it matches one of {original,mutant-1,mutant-2,mutant-3,mutant-4,mutant-5} (The same list applies to all `Dprogram` options below). | `ant check_prog -Dprogram={your program}`                                                                           |
| `check_test`   | Validates that a test is specified and checks if it matches one of the allowed values.    | `ant check_test -Dtest={your test}`                                                                           |
| `compile_prog` | Compiles the specified program, whether it's the original or a mutant version.            | `ant compile_prog -Dprogram={your program}`                                                                         |
| `test`         | Runs the specified test cases against the compiled program. (**The most complete command for you to use**). Results for the tests can be found in the `results/` folder.| `ant test -Dprogram={your program} -Dtest={your test}`                                                    |
| `default`      | Default compile, compiles the original program and `boundaryTests`   | `ant`                                                                                      |
| `clean`        | Cleans up the compiled files and any other generated artifacts.                           | `ant clean`                                                                                |

The command below is an example command to run in a terminal from the root directory of this assignment. It will run the Partition tests you implemented against the original AQMS source code would be:

```shell
ant test -Dprogram="original" -Dtest="PartitioningTests"
```
After you run this command, you could see information in the terminal about whether the build of the program or test is successful or not, and how many tests are passing/failing. 

**可用的构建目标及其用法：**

| 目标名称       | 描述                                                         | 终端命令                                                     |
| -------------- | ------------------------------------------------------------ | ------------------------------------------------------------ |
| `compile_orig` | 编译位于 `src/original/` 目录中的原始程序。                  | `ant compile_orig`                                           |
| `compile_test` | 编译位于 `src/tests/` 目录中的测试用例。测试应与 {PartitioningTests、BoundaryTests} 之一匹配（相同的列表适用于以下所有 `Dtest` 选项） | `ant compile_test -Dtest='PartitioningTests'` 或 <br>`ant compile_test -Dtest='BoundaryTests'` |
| `check_prog`   | 验证是否指定了程序并检查它是否与 {original,mutant-1,mutant-2,mutant-3,mutant-4,mutant-5} 之一匹配（相同的列表适用于下面的所有 `Dprogram` 选项）。 | `ant check_prog -Dprogram={your program}`                    |
| `check_test`   | 验证是否指定了测试并检查它是否与允许的值之一匹配。           | `ant check_test -Dtest={your test}`                          |
| `compile_prog` | 编译指定的程序，无论是原始版本还是突变版本。                 | `ant compile_prog -Dprogram={your program}`                  |
| `test`         | 针对编译后的程序运行指定的测试用例。（**最完整的命令供您使用**）。测试结果可以在 `results/` 文件夹中找到。 | `ant test -Dprogram={your program} -Dtest={your test}`       |
| `default`      | 默认编译，编译原始程序和 `boundaryTests`                     | `ant`                                                        |
| `clean`        | 清理编译的文件和任何其他生成的工件。                         | `ant clean`                                                  |

以下命令是从此作业的根目录在终端中运行的示例命令。它将运行您针对原始 AQMS 源代码实施的分区测试：

```shell
ant test -Dprogram="original" -Dtest="PartitioningTests"
```

运行此命令后，您可以在终端中看到有关程序或测试的构建是否成功以及有多少测试通过/失败的信息。


### Your Tasks:

#### Task 1 -- Equivalence Partitioning

Using the specifications provided in **AQMSSpecs.txt**, apply equivalence partitioning to derive equivalence classes for the 
following methods in the API: `register`, `login`, `assign_role`, and `get_data`.

**Important:** For this task, you should **only** refer to the specifications in **AQMSSpecs.txt**. 
While the `AQMS.java` file includes Javadoc comments, these are for overall software quality purposes. 
Since we are conducting black-box testing in this task, you must derive your test cases 
exclusively from **AQMSSpecs.txt**.

Document your equivalence partitioning process for each method using test template trees, 
listing any assumptions you make. You should create four trees, one for each method. 
You will be marked *only* on your test template trees (plus any assumptions listed), 
so ensure they are clear and concise. Note that as part of your input domain, you must 
consider instance variables if any. These are not parameters to any methods but are still *inputs*.

You may omit some nodes to improve readability, provided it is clear what you intend. 
For example, if testing a book store and you want to test all seven Harry Potter books, 
you could create nodes for books 1 and 7, and use `\ldots` to represent the other five books.

Finally, ensure your set of equivalence classes covers the entire input space. Justify your claim.

#### 任务 1 - 等价划分

使用 **AQMSSpecs.txt** 中提供的规范，应用等价划分来为 API 中的以下方法派生等价类：`register`、`login`、`assign_role` 和 `get_data`。

**重要提示**：对于此任务，您应**仅**参考 **AQMSSpecs.txt** 中的规范。

虽然 `AQMS.java` 文件包含 Javadoc 注释，但这些注释仅用于整体软件质量目的。

由于我们在此任务中进行黑盒测试，因此您必须仅从 **AQMSSpecs.txt** 派生测试用例。

使用测试模板树记录每种方法的等价划分过程，

列出您做出的任何假设。您应该创建四棵树，每种方法一棵树。
您将*仅*在测试模板树（以及列出的任何假设）上被标记，
因此请确保它们清晰简洁。请注意，作为输入域的一部分，您必须
考虑实例变量（如果有）。这些不是任何方法的参数，但仍然是*输入*。

您可以省略一些节点以提高可读性，只要您的意图明确即可。
例如，如果测试一家书店并且您想测试所有七本哈利波特书，
您可以为书 1 和 7 创建节点，并使用`\ldots` 来表示其他五本书。

最后，确保您的等价类集覆盖整个输入空间。证明您的主张。

#### Task 2 -- JUnit Test Driver for Equivalence Partitioning

Select test cases associated with your equivalence classes, and implement them in the JUnit test driver 
located at `tests/swen90006/aqms/PartitioningTests.java`. Use *one* JUnit test method for each equivalence class. 
For each test, clearly identify which equivalence class it has been selected from. 
Once completed, push this script to your Git repository.

Include this as Appendix A in your submission.

**Note:** When implementing tests for a specific method, you may use other methods to verify 
that the first method has worked as expected. Additionally, you might need to execute other methods 
in the class to bring the instance into a testable state (see the example in `PartitioningTests.java`).

#### 任务 2 -- 用于等价分区的 JUnit 测试驱动程序

选择与您的等价类相关的测试用例，并在位于 `tests/swen90006/aqms/PartitioningTests.java` 的 JUnit 测试驱动程序中实现它们。对每个等价类使用 *一个* JUnit 测试方法。
对于每个测试，请清楚地标识它是从哪个等价类中选择的。
完成后，将此脚本推送到您的 Git 存储库。

将其作为附录 A 包含在您的提交中。

**注意：**在为特定方法实现测试时，您可以使用其他方法来验证
第一个方法是否按预期工作。此外，您可能需要执行类中的其他方法
以使实例进入可测试状态（请参阅 `PartitioningTests.java` 中的示例）。

#### Task 3 -- Boundary-Value Analysis

Conduct a boundary-value analysis for your equivalence classes. Document your process and reasoning. 
Select test cases associated with the identified boundary values.

#### 任务 3——边界值分析

对等价类进行边界值分析。记录您的流程和推理。
选择与已确定的边界值相关的测试用例。

#### Task 4 -- JUnit Test Driver for Boundary-Value Analysis

Implement your boundary-value tests in the JUnit test driver located at `test/swen90006/aqms/BoundaryTests.java`. 
As before, use *one* JUnit test method for each test input. Once completed, push this script to your Git repository.

Include this as Appendix B in your submission.

**Note:** The `BoundaryTests` JUnit script inherits from `PartitioningTests`, which means all tests 
from `PartitioningTests` are included in `BoundaryTests`. A JUnit test is simply a standard public Java class! 
You may choose to remove this inheritance, but you can also use it to your advantage to make the `BoundaryTests` 
script easier to create. Overriding an existing test will replace it in the `BoundaryTests` script.

#### 任务 4 -- 用于边界值分析的 JUnit 测试驱动程序

在位于 `test/swen90006/aqms/BoundaryTests.java` 的 JUnit 测试驱动程序中实现边界值测试。

与之前一样，对每个测试输入使用 *一个* JUnit 测试方法。完成后，将此脚本推送到您的 Git 存储库。

将其作为附录 B 包含在您的提交中。

**注意：**`BoundaryTests` JUnit 脚本继承自 `PartitioningTests`，这意味着 `PartitioningTests` 中的所有测试都包含在 `BoundaryTests` 中。JUnit 测试只是一个标准的公共 Java 类！

您可以选择删除此继承，但您也可以利用它来使 `BoundaryTests` 脚本更易于创建。覆盖现有测试将在 `BoundaryTests` 脚本中替换它。

#### Task 5 -- Coverage-based Testing

Measure the effectiveness of the two test suites (equivalence partitioning and boundary-value analysis). For this task, you should perform these three sub-tasks:

1. Draw a control flow graph of the `register` method. 
2. Calculate the coverage score of your two test suites using *condition coverage* for the `isValidUsername` method. Note that you can access the source code in Coverage-based Testing part, and the `isValidUsername` method is called by the `register` method.  
3. Calculate the converage score of your two test suites using *multi-condition coverage* for the `register` method. 

**Note:** For the entire Coverage-based Testing part, you do not need to consider any inter-procedural analysis, that means, you only need to use information available for that function. For example, to investigate the `login` method, you do not need to draw control flow graph or measure coverage referencing inside the methods called by the `login` method. 

Show your working for the coverage calculation in a table that lists each test objective (that is, each combination for multiple-condition coverage or each condition for condition coverage) and one test that achieves this, if any. 

You will reveive marks for each of the sub-tasks. For drawing the correct control flow graph, deriving correct coverage scores and showing how you come to this score. No marks are allocated for having a higher coverage score. 

#### 任务 5——基于覆盖率的测试

测量两个测试套件的有效性（等价性划分和边界值分析）。对于此任务，您应该执行以下三个子任务：

1. 绘制 `register` 方法的控制流图。
2. 使用 `isValidUsername` 方法的 *条件覆盖率* 计算两个测试套件的覆盖率得分。请注意，您可以在基于覆盖率的测试部分访问源代码，并且 `isValidUsername` 方法由 `register` 方法调用。
3. 使用 `register` 方法的 *多条件覆盖率* 计算两个测试套件的收敛得分。

**注意：**对于整个基于覆盖率的测试部分，您无需考虑任何过程间分析，这意味着，您只需要使用该函数可用的信息。例如，要研究 `login` 方法，您无需绘制控制流图或测量 `login` 方法调用的方法内的覆盖率引用。

在表格中展示您的覆盖率计算工作，该表格列出了每个测试目标（即，多条件覆盖的每个组合或条件覆盖的每个条件）以及实现该目标的一项测试（如果有）。

您将获得每个子任务的分数。绘制正确的控制流图、得出正确的覆盖率分数并展示您如何获得此分数。覆盖率分数越高，得分越高。


#### Task 6 -- Mutation selection

Derive five *non-equivalent* mutants for the AQMS class using only the nine Java mutation operators in the subject notes. These mutants should be difficult to find using testing. Insert each of these mutants into the files `programs/mutant-1/swen90006/aqms/AQMS.java`, `programs/mutant-2/swen90006/aqms/AQMS.java`, etc.

All five mutants must be non-equivalent AND each mutant must be killed by at least one test in your JUnit BoundaryTest script to demonstrate that they are non-equivalent. They must be in code that is executed when calling one of the four methods tested in Task 1, this includes code in the functions that one of the four methods calls, but excludes functions throwing execptions or functions not implemented by the teaching team (e.g., Java built-in functions). 

Importantly, do not change anything else about the mutant files except for inserting the mutant.

Each mutant must change exactly one line of `AQMS.java` for each version `mutant-1`, `mutant-2`, etc.

#### 任务 6——突变选择

仅使用主题注释中的九个 Java 突变运算符，为 AQMS 类导出五个 *非等效* 突变体。这些突变体应该很难通过测试找到。将这些突变体中的每一个插入文件 `programs/mutant-1/swen90006/aqms/AQMS.java`、`programs/mutant-2/swen90006/aqms/AQMS.java` 等。

所有五个突变体都必须是非等效的，并且每个突变体都必须被 JUnit BoundaryTest 脚本中的至少一个测试杀死，以证明它们是非等效的。它们必须位于调用任务 1 中测试的四种方法之一时执行的代码中，这包括四种方法之一调用的函数中的代码，但不包括抛出异常的函数或教学团队未实现的函数（例如，Java 内置函数）。

重要的是，除了插入突变体之外，不要更改突变体文件的任何其他内容。

每个突变体必须为每个版本“突变体-1”、“突变体-2”等更改“AQMS.java”的一行。

#### Task 7 -- Comparison
Compare the two set of test cases (equivalence partitioning and boundary-value analysis) and their results. Which method did you find was more effective and why? You should consider the coverage of the valid input/output domain, the coverage achieved, and the mutants it kills. Limit your comparison to half a page. If your comparision is over half a page, you will be marked only on the first half page. 

#### 任务 7——比较

比较两组测试用例（等价划分和边界值分析）及其结果。您发现哪种方法更有效，为什么？您应该考虑有效输入/输出域的覆盖范围、实现的覆盖范围以及它消除的突变体。将比较限制在半页以内。如果您的比较超过半页，您将只在前半页上给分。

## Marking criteria

| Criterion  | Description  | Marks  |
|---|---|---|
| Equivalence partitioning  | Clear evidence that partitioning the input space to find equivalence classes has been done systematically and correctly. Resulting equivalence classes are disjoint and cover the appropriate input space | 6 |
| Boundary-value analysis | Clear evidence that boundary-value analysis has been applied systematically and correctly, and all boundaries, including on/off points, have been identified | 3 |
| Control-flow analysis    | Clear evidence that the control flow graph is derived systematically and correctly. Resulting control flow graph reflects the branches and loops of the specified function  |  2    |
|                          | Clear evidence that measurement of the control-flow criterion has been done systematically and correctly	 |  2   |
|                          | Clear and succinct justification/documentation of which test covers each objective	 |  2   |
|  Original tests           | No build failure, no failing tests | 1   |
|Mutant score| All your mutants are killed, no equivalent mutants | 1 |
| Staff mutant score                | Your tests kill all mutants that the teaching team creates| 2 |
| Discussion               | Clear demonstration of understanding of the topics used in the assignment, presented in a logical manner |   1   |
| **Total** |   | 20 |

For the Original tests, we award 1 mark if your JUnit test does not have build failure, and your test suite **does not fail** against the original code base. If you do not receive the mark for the original tests, you will also receive no mark for the Mutant score and staff mutant score part. 

## 评分标准

| 标准         | 描述                                                         | 分数 |
| ------------ | ------------------------------------------------------------ | ---- |
| 等价划分     | 有明确证据表明已系统且正确地划分输入空间以查找等价类。 得到的等价类是不相交的并且覆盖适当的输入空间 | 6    |
| 边界值分析   | 有明确证据表明已系统且正确地应用了边界值分析，并且已确定了所有边界（包括开/关点） | 3    |
| 控制流分析   | 有明确证据表明控制流图是系统且正确地得出的。 得到的控制流图反映了指定函数的分支和循环 | 2    |
|              | 有明确证据表明已系统且正确地测量了控制流标准                 | 2    |
|              | 清晰简洁地论证/记录哪个测试涵盖每个目标                      | 2    |
| 原始测试     | 没有构建失败，没有失败的测试                                 | 1    |
| 突变分数     | 所有突变均被杀死，无等效突变                                 | 1    |
| 员工突变分数 | 您的测试杀死了教学团队创建的所有突变                         | 2    |
| 讨论         | 清晰展示对作业中使用的主题的理解，以合乎逻辑的方式呈现       | 1    |
| **总计**     |                                                              | 20   |

对于原始测试，如果您的 JUnit 测试没有构建失败，并且您的测试套件**没有失败**原始代码库，我们将授予 1 分。如果您没有获得原始测试的分数，您也将不会获得突变分数和员工突变分数部分的分数。

**Important**: We determine that a mutant is killed when JUnit contains a failed test. Because of this, if a test case fails when applied to the original source code, it will fail on most of your mutants, and the staff mutants. With that being said, if your find a test that supposed to pass according to the spec, but fails in the original source code, pleast let us know via a private thread showing your test cases on the discussion board. 

For Mutant score, we award 1 mark if your JUnit test kills all your own mutant, that means some test in your JUnit tests fail when applied to your mutants. 

If not all mutant killed, we give mark using the following formula:

Mutant_score = mutants_killed / 5 * 1 - penalty_for_equivalent_mutant

For Staff mutant score, the teaching team will create five mutants following the same instruction in Task 6. we award 2 marks if all staff mutants are killed by some of your tests. This part ensures that your mutant and your test cases aiming to kill the mutant is not deliberatly crafted.

If not all mutant killed, we give mark using the following formula:

Staff_mutant_score = staff_mutants_killed / 5 * 2

**重要**：我们确定当 JUnit 包含失败的测试时，突变体会被终止。因此，如果测试用例在应用于原始源代码时失败，它将在您的大多数突变体和工作人员突变体上失败。话虽如此，如果您发现一个测试应该根据规范通过，但在原始源代码中失败，请通过讨论板上显示您的测试用例的私人线程让我们知道。

对于突变体分数，如果您的 JUnit 测试终止了您自己的所有突变体，我们会奖励 1 分，这意味着您的 JUnit 测试中的一些测试在应用于您的突变体时会失败。

如果不是所有突变体都被杀死，我们将使用以下公式给出分数：

突变体得分 = 突变体被杀死 / 5 * 1 - 等效突变体惩罚

对于工作人员突变体得分，教学团队将按照任务 6 中的相同说明创建五个突变体。如果所有工作人员突变体都被您的一些测试杀死，我们将奖励 2 分。这部分确保您的突变体和旨在杀死突变体的测试用例不是故意制作的。

如果不是所有突变体都被杀死，我们将使用以下公式给出分数：

工作人员突变体得分 = 工作人员突变体被杀死 / 5 * 2

## Submission instructions

### JUnit script submission 
For the JUnit test scripts, we will clone everyone's repository at the due time. We will mark the latest version on the main branch of the repository. To have any late submissions marked, please email Hira ([`hira.syeda@unimelb.edu.au`](mailto:hira.syeda@unimelb.edu.au)) to let her know to pull changes from your repository.

Some important instructions:

1. Do NOT change the package names in any of the files.
2. Do NOT change the directory structure.
3. Do NOT add any new files: you should be able to complete the assignment without adding any new source files.

JUnit scripts will be batch run automatically, so any script that does not follow the instructions will not run and will not be awarded any marks.

### JUnit 脚本提交

对于 JUnit 测试脚本，我们将在适当的时候克隆每个人的存储库。我们将在存储库的主分支上标记最新版本。要标记任何迟交的提交，请发送电子邮件给 Hira ([`hira.syeda@unimelb.edu.au`](mailto:hira.syeda@unimelb.edu.au))，让她知道从您的存储库中提取更改。

一些重要说明：

1. 请勿更改任何文件中的包名称。
2. 请勿更改目录结构。
3. 请勿添加任何新文件：您应该能够在不添加任何新源文件的情况下完成作业。

JUnit 脚本将自动批量运行，因此任何不遵循说明的脚本都不会运行，也不会获得任何分数。

### Report submission
For the remainder of the assignment (test template tree, boundary-value analysis working, coverage, and discussion) submit a PDF file using the links on the subject Canvas site. Go to the SWEN90006 Canvas site, select *Assignments* from the subject menu, and submit in *Assignment 1 report*.

### 报告提交

对于作业的其余部分（测试模板树、边界值分析工作、覆盖范围和讨论），请使用主题 Canvas 网站上的链接提交 PDF 文件。转到 SWEN90006 Canvas 网站，从主题菜单中选择 *作业*，然后提交 *作业 1 报告*。

## Tips

Some tips to managing the assignment, in particular, the equivalence partitioning:

1. Ensure that you understand the notes *before* diving into the assignment. Trying to learn equivalence partitioning or boundary-value analysis on a project this size is difficult. If you do not understand the simple examples in the notes, the understanding will not come from applying to a more complex example.
2. Keep it simple: don't focus on what you think we want to see --- focus on looking for good tests and then documenting them in a systematic way.  That IS what we want to see.
3. Focus on the requirements: as with any testing effort, focus your testing on the requirements, NOT on demonstrating the theory from the notes. Simply look at each requirement and see which guidelines should apply.
4. If you cannot figure out how to start your test template tree, just start listing tests that you think are important. Once you have a list, think about putting them into a tree.

## 提示

一些管理作业的提示，特别是等价划分：

1. 在深入研究作业之前，确保您理解笔记。尝试在如此规模的项目上学习等价划分或边界值分析是很困难的。如果您不理解笔记中的简单示例，那么理解将不会来自应用于更复杂示例。

2. 保持简单：不要关注您认为我们想看到的内容 --- 专注于寻找好的测试，然后以系统的方式记录它们。这就是我们想看到的。

3. 关注需求：与任何测试工作一样，将测试重点放在需求上，而不是展示笔记中的理论。只需查看每个要求并查看应应用哪些指南。

4. 如果您无法弄清楚如何开始测试模板树，只需开始列出您认为重要的测试。一旦您有了列表，请考虑将它们放入树中。

### Late submission policy

If you require an extension, please contact Hira ([`hira.syeda@unimelb.edu.au`](mailto:hira.syeda@unimelb.edu.au)) to discuss. Having assessments due for other subjects is not a valid reason for an extension.

By default, everyone is implicitly granted an extension of up to 7 days, but with a penalty of 10% (2 marks) per day that the assignment is submitted late. So, if you are falling behind, you may want to consider submitted 1-2 days late if you feel you can do enough to make up the 2-4 marks. 

If you submit late, email Hira to let her know so she can pull the changes from the repository.

### Academic Misconduct

The University academic integrity policy (see [https://academicintegrity.unimelb.edu.au/](https://academicintegrity.unimelb.edu.au/) applies. Students are encouraged to discuss the assignment topic, but all submitted work must represent the individual's understanding of the topic. 

The subject staff take academic misconduct very seriously. In this subject in the past, we have successfully prosecuted several students that have breached the university policy. Often this results in receiving 0 marks for the assessment, and in some cases, has resulted in failure of the subject. 

### Originality Multiplier

For work that we find is similar to another submission or information found online, an originality multiplier will be applied to the work.  For example, if 20% of the assessment is deemed to have been taken from another source, the final mark will be multiplied by 0.8.
